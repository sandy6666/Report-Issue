<?php


namespace Sandesh\ReportIssue\Block;

use Magento\Framework\View\Element\Template;

class SaveForm extends Template
{
    /**
     * @return String
     */
    public function getFormUrl(): string
    {
        return $this->getUrl('reportissue/index/save');
    }
}
