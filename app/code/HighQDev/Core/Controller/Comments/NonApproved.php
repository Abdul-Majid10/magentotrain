<?php
declare(strict_types=1);

namespace HighQDev\Core\Controller\Comments;

use Magento\Customer\Model\SessionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class NonApproved
 * @package HighQDev\Core\Controller\Comments
 */
class NonApproved extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var SessionFactory
     */
    protected $sessionFactory;

    /**
     * NonApproved constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param SessionFactory $sessionFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        SessionFactory $sessionFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->sessionFactory = $sessionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->_pageFactory->create();
    }

    /**
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface|null
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function dispatch(RequestInterface $request)
    {
        if (!$this->sessionFactory->create()->authenticate()) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }
        return parent::dispatch($request);
    }
}
