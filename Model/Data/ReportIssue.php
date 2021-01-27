<?php

namespace Sandesh\ReportIssue\Model\Data;

use Magento\Framework\Model\AbstractModel;
use Sandesh\ReportIssue\Api\Data\ReportIssueInterface;
use Sandesh\ReportIssue\Model\ResourceModel\ReportIssue as ResourceModel;

class ReportIssue extends AbstractModel implements ReportIssueInterface
{

    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId(): int
    {
        return $this->getData('entity_id');
    }

    /**
     * @inheritDoc
     */
    public function setEntityId($entityId): ReportIssueInterface
    {
        return $this->setData('entity_id', $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getUserName(): string
    {
        return $this->getData('user_name');
    }

    /**
     * @inheritDoc
     */
    public function setUserName(string $name): ReportIssueInterface
    {
        return $this->setData('user_name', $name);
    }

    /**
     * @inheritDoc
     */
    public function getPhoneNumber(): string
    {
        return $this->getData('phone_number');
    }

    /**
     * @inheritDoc
     */
    public function setPhoneNumber(string $number): ReportIssueInterface
    {
        return $this->setData('phone_number', $number);
    }

    /**
     * @inheritDoc
     */
    public function getStoreId(): string
    {
        return $this->getData('store_id');
    }

    /**
     * @inheritDoc
     */
    public function setStoreId(int $storeId): ReportIssueInterface
    {
        return $this->setData('store_id', $storeId);
    }

    /**
     * @inheritDoc
     */
    public function getMagentoCustomerId(): int
    {
        return $this->getData('magento_customer_id');
    }

    /**
     * @inheritDoc
     */
    public function setMagentoCustomerId(int $id): ReportIssueInterface
    {
        return $this->setData('magento_customer_id', $id);
    }

    /**
     * @inheritDoc
     */
    public function getMagentoCustomerName(): string
    {
        return $this->getData('magento_customer_name');
    }

    /**
     * @inheritDoc
     */
    public function setMagentoCustomerName(string $name): ReportIssueInterface
    {
        return $this->setData('magento_customer_name', $name);
    }

    /**
     * @inheritDoc
     */
    public function getEmailId(): string
    {
        return $this->getData('email_id');
    }

    /**
     * @inheritDoc
     */
    public function setEmailId(string $emailId): ReportIssueInterface
    {
        return $this->setData('email_id', $emailId);
    }

    /**
     * @inheritDoc
     */
    public function getIssueTitle(): string
    {
        return $this->getData('issue_title');
    }

    /**
     * @inheritDoc
     */
    public function setIssueTitle(string $title): ReportIssueInterface
    {
        return $this->setData('issue_title', $title);
    }

    /**
     * @inheritDoc
     */
    public function getIssueDescription(): string
    {
        return $this->getData('issue_description');
    }

    /**
     * @inheritDoc
     */
    public function setIssueDescription(string $description): ReportIssueInterface
    {
        return $this->setData('issue_description', $description);
    }

    /**
     * @inheritDoc
     */
    public function getReportedTime(): string
    {
        return $this->getData('reported_time');
    }

    /**
     * @inheritDoc
     */
    public function setReportedTime(string $time): ReportIssueInterface
    {
        return $this->setData('reported_time', $time);
    }
}
