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
namespace Lof\OnePageReviews\Block;

/**
 * Class OnePageReviews
 * @package Lof\OnePageReviews\Block
 */
class OnePageReviews extends \Magento\Framework\View\Element\Template
{

    /**
     * OnePageReviews constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory $_reviewsColFactory
     * @param \Lof\OnePageReviews\Helper\Data $helper
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory $_reviewsColFactory,
        \Lof\OnePageReviews\Helper\Data $helper
    ) {
    
        $this->_reviewsColFactory = $_reviewsColFactory;
        parent::__construct($context);
        $this->helper = $helper;
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function _construct()
    {
        parent::_construct();
        
        $collection = $this->_reviewsColFactory->create()->addStoreFilter(
            $this->_storeManager->getStore()->getId()
        )->addStatusFilter(
            \Magento\Review\Model\Review::STATUS_APPROVED
        )
            
            ->setDateOrder();
            
        $this->setCollection($collection);
    }

    /**
     * @return $this|\Magento\Framework\View\Element\Template
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function _prepareLayout()
    {
        parent::_prepareLayout();
        
        $pager = $this->getLayout()->createBlock(
            \Magento\Theme\Block\Html\Pager::class,
            'lof_onepagereviews.pager'
        )->setTemplate('Lof_OnePageReviews::html/pager.phtml');
        
        $pager->setShowAmounts(false)->setCollection($this->getCollection());
        
        $this->setChild('pager', $pager);
        
        $pagetitle = $this->helper->getTitle();
        
        if ($pagetitle && !empty($pagetitle)) {
            $this->pageConfig->getTitle()->set($pagetitle);
        } else {
            $this->pageConfig->getTitle()->set(__('Reviews'));
        }
 
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return \Magento\Framework\View\Element\Template
     */
    protected function _beforeToHtml()
    {
        $this->getCollection()->load()->addReviewSummary();
        return parent::_beforeToHtml();
    }
}
