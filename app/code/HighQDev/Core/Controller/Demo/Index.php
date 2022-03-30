<?php
declare(strict_types=1);

namespace HighQDev\Core\Controller\Demo;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Review\Controller\Customer;

/**
 * Class Index
 * @package HighQDev\Core\Controller\Demo
 */
class Index extends Customer
{

    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Session $customerSession
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Session $customerSession
    )
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context, $customerSession);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
