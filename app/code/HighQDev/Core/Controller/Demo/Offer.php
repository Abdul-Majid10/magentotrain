<?php
declare(strict_types=1);

namespace HighQDev\Core\Controller\Demo;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Offer
 * @package HighQDev\Core\Controller\Demo
 */
class Offer extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * Offer constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
