<?php
declare(strict_types=1);

namespace HighQDev\Core\Controller\Comments;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class GetList
 * @package HighQDev\Core\Controller\Comments
 */
class GetList extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * View constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, JsonFactory $resultJsonFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $result = $this->_resultJsonFactory->create();
        $resultPage = $this->_resultPageFactory->create();
        $status = $this->getRequest()->getParam('status');
        $data = array('status' => $status);

        if ($status) {
            $block = $resultPage->getLayout()
                ->createBlock('HighQDev\Core\Block\Comments\approved\GetList')
                ->setTemplate('HighQDev_Core::comments/approved/list.phtml')
                ->setData('data', $data)
                ->toHtml();
        } else {
            $block = $resultPage->getLayout()
                ->createBlock('HighQDev\Core\Block\Comments\NonApproved\GetList')
                ->setTemplate('HighQDev_Core::comments/nonApproved/list.phtml')
                ->setData('data', $data)
                ->toHtml();
        }

        $result->setData(['output' => $block]);
        return $result;
    }
}
