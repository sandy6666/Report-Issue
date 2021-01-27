<?php

namespace Sandesh\ReportIssue\Model\ResourceModel\ReportIssue;

use Sandesh\ReportIssue\Model\Data\ReportIssue;
use Sandesh\ReportIssue\Model\ResourceModel\ReportIssue as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(ReportIssue::class, ResourceModel::class);
    }
}
