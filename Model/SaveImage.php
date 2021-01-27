<?php

namespace Sandesh\ReportIssue\Model;

use Magento\Config\Model\Config\Backend\Image;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class SaveImage
 * @package Sandesh\ReportIssue\Model
 */
class SaveImage extends Image
{
    /**
     * The tail part of directory path for uploading
     */

    const UPLOAD_DIR = 'sandesh/button';

    /**
     * Upload max file size in kilobytes
     *
     * @var int
     */
    protected $_maxFileSize = 2048;

    /**
     * Return path to directory for upload file
     *
     * @return string
     */
    protected function _getUploadDir()
    {
        return $this->_mediaDirectory->getAbsolutePath($this->_appendScopeInfo(self::UPLOAD_DIR));
    }

    /**
     * Makes a decision about whether to add info about the scope
     *
     * @return boolean
     */
    protected function _addWhetherScopeInfo()
    {
        return true;
    }

    /**
     * Save uploaded file before saving config value
     *
     * Save changes and delete file if "delete" option passed
     *
     * @return $this
     * @throws LocalizedException
     */
    public function beforeSave()
    {
        $value = $this->getValue();
        return parent::beforeSave();
    }
}
