<?php

namespace Sandesh\ReportIssue\Model\Config;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Source
 * @package Sandesh\ReportIssue\Model\Config
 */
class Source implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 'text', 'label' => __('Text')],
            ['value' => 'image', 'label' => __('Image')]
        ];
    }
}
