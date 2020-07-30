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
namespace Lof\OnePageReviews\Controller;

/**
 * Class Router
 * @package Lof\OnePageReviews\Controller
 */
class Router implements \Magento\Framework\App\RouterInterface
{
    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * @var \Lof\OnePageReviews\Helper\Data
     */
    protected $helper;

    /**
     * Router constructor.
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Lof\OnePageReviews\Helper\Data $helper
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Lof\OnePageReviews\Helper\Data $helper
    ) {
   
        $this->actionFactory = $actionFactory;
        $this->helper = $helper;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface|null
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        
        if (!$this->helper->isEnabled()) {
            return null;
        }
        
        $identifier = trim($request->getPathInfo(), '/');
        $onepagereviews_url = trim($this->helper->getUrl());
        
        if (empty($onepagereviews_url) || $identifier != $onepagereviews_url) {
            return null;
        }
       
        $request->setModuleName('onepagereviews')->setControllerName('page')->setActionName('view');
        $request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $onepagereviews_url);
        return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class);
    }
}
