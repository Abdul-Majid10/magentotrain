<?php
declare(strict_types=1);

namespace HighQDev\Core\Controller\Comments;

use HighQDev\Core\Model\CommentFactory;
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
        /**
         * @var $comment \HighQDev\Core\Model\Comment
         */
        $comment = $this->commentFactory->create();

        $comment->setSku($this->_request->getParam('productSKU'));
        $comment->setCommentText($this->_request->getParam('comment'));
        $comment->setCommentApproved(false);

        $comment->save();

        $this->messageManager->addSuccessMessage("Comment Added");

        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl('/demo/demo/index');

        return $redirect;
    }
}
