<?php

namespace Sandesh\ReportIssue\Controller\Index;

use Exception;
use Magento\Customer\Model\Session;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Message\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Sandesh\ReportIssue\Api\ReportIssueRepositoryInterface;

class Save implements ActionInterface
{
    /**
     * @var Http
     */
    private $http;
    /**
     * @var ReportIssueRepositoryInterface
     */
    private $reportIssueRepository;
    /**
     * @var ManagerInterface
     */
    private $manager;
    /**
     * @var Redirect
     */
    private $redirect;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * Save constructor.
     * @param Http $http
     * @param ReportIssueRepositoryInterface $reportIssueRepository
     * @param ManagerInterface $manager
     * @param Redirect $redirect
     * @param Session $session
     * @param StoreManagerInterface $storeManager
     * @param EventManager $eventManager
     */
    public function __construct(
        Http $http,
        ReportIssueRepositoryInterface $reportIssueRepository,
        ManagerInterface $manager,
        Redirect $redirect,
        Session $session,
        StoreManagerInterface $storeManager,
        EventManager $eventManager
    ) {
        $this->http = $http;
        $this->reportIssueRepository = $reportIssueRepository;
        $this->manager = $manager;
        $this->redirect = $redirect;
        $this->session = $session;
        $this->storeManager = $storeManager;
        $this->eventManager = $eventManager;
    }

    public function execute()
    {
        try {
            $model = $this->reportIssueRepository->create();
            $this->populateModelWithData($model, [
                'user_name',
                'phone_number',
                'email_id',
                'issue_title',
                'issue_description'
            ]);
            $customerObject = $this->session->getCustomer();
            if ($customerObject->getId()) {
                $model->setMagentoCustomerId($customerObject->getId());
                $model->setMagentoCustomerName($customerObject->getName());
                $model->setStoreId($customerObject->getStoreId());
            } else {
                $model->setMagentoCustomerId(0);
                $model->setMagentoCustomerName("Guest");
                $model->setStoreId($this->storeManager->getStore()->getId());
            }
            $this->eventManager->dispatch(
                'report_issue_save_before',
                [
                    'report_issue' => $model
                ]
            );
            $model = $this->reportIssueRepository->save($model);
            $this->eventManager->dispatch(
                'report_issue_save_after',
                [
                    'report_issue' => $model
                ]
            );
            $this->manager->addSuccessMessage(__("Issue has been reported Successfully"));
            return $this->redirect->setPath('reportissue/index/index');
        } catch (Exception $e) {
            $this->manager->addErrorMessage(__($e->getMessage()));
        }
        return $this->redirect->setPath('reportissue/index/index');
    }

    protected function populateModelWithData($model, $fields)
    {
        foreach ($fields as $field) {
            $model->setData($field, $this->http->getParam($field));
        }
    }
}
