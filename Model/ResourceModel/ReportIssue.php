<?php

namespace Sandesh\ReportIssue\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ReportIssue extends AbstractDb
{

    const MAIN_TABLE = 'reported_issues';
    const ID_FIELD_NAME = 'id';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
