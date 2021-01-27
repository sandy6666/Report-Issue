<?php

namespace Sandesh\ReportIssue\Api\Data;

interface ReportIssueInterface
{
    /**
     * @return int
     */
    public function getEntityId(): int;

    /**
     * @param int $entityId
     * @return $this
     */
    public function setEntityId(int $entityId): ReportIssueInterface;

    /**
     * @return string
     */
    public function getUserName(): string;

    /**
     * @param string $name
     * @return $this
     */
    public function setUserName(string $name): ReportIssueInterface;

    /**
     * @return string
     */
    public function getPhoneNumber(): string;

    /**
     * @param string $number
     * @return $this
     */
    public function setPhoneNumber(string $number): ReportIssueInterface;

    /**
     * @return string
     */
    public function getStoreId(): string;

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreId(int $storeId): ReportIssueInterface;

    /**
     * @return int
     */
    public function getMagentoCustomerId(): int;

    /**
     * @param int $id
     * @return $this
     */
    public function setMagentoCustomerId(int $id): ReportIssueInterface;

    /**
     * @return string
     */
    public function getMagentoCustomerName(): string;

    /**
     * @param string $name
     * @return $this
     */
    public function setMagentoCustomerName(string $name): ReportIssueInterface;

    /**
     * @return string
     */
    public function getEmailId(): string;

    /**
     * @param string $emailId
     * @return $this
     */
    public function setEmailId(string $emailId): ReportIssueInterface;

    /**
     * @return string
     */
    public function getIssueTitle(): string;

    /**
     * @param string $title
     * @return $this
     */
    public function setIssueTitle(string $title): ReportIssueInterface;

    /**
     * @return string
     */
    public function getIssueDescription(): string;

    /**
     * @param string $description
     * @return $this
     */
    public function setIssueDescription(string $description): ReportIssueInterface;

    /**
     * @return string
     */
    public function getReportedTime(): string;

    /**
     * @param string $time
     * @return $this
     */
    public function setReportedTime(string $time): ReportIssueInterface;
}
