<?php
declare(strict_types=1);

namespace HighQDev\Core\Controller\Comments;

use HighQDev\Core\Model\CommentFactory;
use Magento\Customer\Model\SessionFactory;
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
     * @var SessionFactory
     */
    protected $sessionFactory;

    /**
     * AddComment constructor.
     * @param Context $context
     * @param ResultFactory $resultFactory
     * @param CommentFactory $commentFactory
     * @param SessionFactory $sessionFactory
     */
    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        CommentFactory $commentFactory,
        SessionFactory $sessionFactory
    )
    {
        $this->resultFactory = $resultFactory;
        $this->commentFactory = $commentFactory;
        $this->sessionFactory = $sessionFactory;
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

        /**
         * @var $customerSession \Magento\Customer\Model\Session
         */
        $customerSession = $this->sessionFactory->create();

        /**
         * @var $sku int
         */
        $sku = $this->_request->getParam('productSKU');

        /**
         * @var $commentText String
         */
        $commentText = $this->_request->getParam('comment');

        /**
         * @var $customerId int
         */
        $customerId = (int)$customerSession->getCustomerId();
        if ($sku !== '' && $commentText !== '') {
            $comment->setSku($sku);
            $comment->setCommentText($commentText);
            $comment->setCommentApproved(false);
            $comment->setCustomerId($customerId);
            $comment->save();
            $this->messageManager->addSuccessMessage("Comment Added");
        } else {
            $this->messageManager->addErrorMessage("Request Failed");
            $this->messageManager->addWarningMessage("Make Sure You Write Product SKU and Comment");
        }
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl('/demo/demo/index');
        return $redirect;
    }
}
