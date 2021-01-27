<?php

namespace Sandesh\ReportIssue\Block;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Button
 * @package Sandesh\ReportIssue\Block
 */
class Button extends Template
{
    const XML_PATH_TO_CONFIG_VALUES = [
        'input_type' => 'reportedissue/issues/type',
        'text' => 'reportedissue/issues/text',
        'button_bgcolor' => 'reportedissue/issues/button_bgcolor',
        'image' => 'reportedissue/issues/image'
    ];

    /**
     * Button constructor.
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        $data = [];
        try {
            $url = $this->_storeManager
                    ->getStore()
                    ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'sandesh/button/';
            $data = [
                'type' => $this->_scopeConfig->getValue(
                    self::XML_PATH_TO_CONFIG_VALUES['input_type'],
                    ScopeInterface::SCOPE_STORES,
                    $this->_storeManager->getStore()->getCode()
                ),
                'text' => $this->_scopeConfig->getValue(
                    self::XML_PATH_TO_CONFIG_VALUES['text'],
                    ScopeInterface::SCOPE_STORES,
                    $this->_storeManager->getStore()->getCode()
                ),
                'image' => $this->_scopeConfig->getValue(
                    self::XML_PATH_TO_CONFIG_VALUES['image'],
                    ScopeInterface::SCOPE_STORES,
                    $this->_storeManager->getStore()->getCode()
                ),
                'color' => $this->_scopeConfig->getValue(
                    self::XML_PATH_TO_CONFIG_VALUES['button_bgcolor'],
                    ScopeInterface::SCOPE_STORES,
                    $this->_storeManager->getStore()->getCode()
                ),
                'media_url' => $url,
                'url' => $this->getUrl('reportissue/*/*')
            ];
            return $data;
        } catch (NoSuchEntityException $e) {
            $this->_logger->critical($e->getMessage(), $e->getTrace());
        }
        return $data;
    }
}
