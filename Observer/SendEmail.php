<?php

namespace Sandesh\ReportIssue\Observer;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Sandesh\ReportIssue\Api\Data\ReportIssueInterface;

class SendEmail implements ObserverInterface
{
    const XML_PATH_TO_EMAILS = 'reportedissue/notify_reported_issue_email/email';
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var TransportBuilder
     */
    private $transportBuilder;
    /**
     * @var TimezoneInterface
     */
    private $timezone;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SendEmail constructor.
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     * @param TransportBuilder $transportBuilder
     * @param TimezoneInterface $timezone
     * @param LoggerInterface $logger
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        TransportBuilder $transportBuilder,
        TimezoneInterface $timezone,
        LoggerInterface $logger
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->transportBuilder = $transportBuilder;
        $this->timezone = $timezone;
        $this->logger = $logger;
    }
    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        /** @var ReportIssueInterface $reportedIssue */
        $reportedIssue = $observer->getReportIssue();
        try {
            $emails = $this->scopeConfig->getValue(self::XML_PATH_TO_EMAILS, ScopeInterface::SCOPE_STORE);
            $emails = explode(',', $emails);
            $store = $this->storeManager->getStore()->getStoreId();
            $date = $this->timezone->date()->format('D-M-Y');
            $time = $this->timezone->date()->format('h:m:s:a');
            $transport = $this->transportBuilder->setTemplateIdentifier('report_issue_template')
                ->setTemplateOptions(['area' => 'frontend', 'store' => $store])
                ->setTemplateVars(
                    [
                        'userName'=>$reportedIssue->getUserName(),
                        'emailId'=>$reportedIssue->getEmailId(),
                        'issueTitle'=>$reportedIssue->getIssueTitle(),
                        'issueDescription'=>$reportedIssue->getIssueDescription(),
                        'date'=>$date,
                        'time'=>$time
                    ]
                )
                ->setFromByScope('general', $store)
                ->addTo($emails)
                ->getTransport();
            $transport->sendMessage();
        } catch (MailException | NoSuchEntityException | LocalizedException $e) {

        }
    }
}
