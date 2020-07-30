<?php
/**
 * Lof
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Lof.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Lof
 * @package     Lof_OnePageReviews
 * @copyright   Copyright (c) 2020 Lof (https://landofcoder.com/)
 * @license     https://landofcoder.com/LICENSE.txt
 */
namespace Lof\OnePageReviews\Helper;

/**
 * Class Data
 * @package Lof\OnePageReviews\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_ENABLED = 'onepagereviews/general/enabled';
    const XML_PATH_URL = 'onepagereviews/general/url';
    const XML_PATH_TITLE = 'onepagereviews/general/title';

    /**
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_TITLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
