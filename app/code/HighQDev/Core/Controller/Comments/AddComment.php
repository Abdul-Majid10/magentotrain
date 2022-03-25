<?php
declare(strict_types=1);

namespace HighQDev\Core\Controller\Comments;

use HighQDEV\Core\Model\CommentFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class AddComment
 * @package HighQDev\Core\Controller\Comments
 */
class AddComment extends Action
{
    /**
     * @var resultFactory
     */
    protected $resultFactory;

    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * AddComment constructor.
     * @param Context $context
     * @param ResultFactory $resultFactory
     * @param CommentFactory $commentFactory
     */
    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        CommentFactory $commentFactory
    )
    {
        $this->resultFactory = $resultFactory;
        $this->commentFactory = $commentFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Layout
     * @throws \Exception
     */
    public function execute()
    {
        $this->messageManager->addSuccessMessage("Comment Added");

        $comment = $this->commentFactory->create();

        $comment->setData("sku", $this->_request->getParam('productSKU'));
        $comment->setData("comment_text", $this->_request->getParam('comment'));

        $comment->save();

        $this->messageManager->addSuccessMessage("Comment Added");

        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl('/demo/demo/index');

        return $redirect;
    }
}
