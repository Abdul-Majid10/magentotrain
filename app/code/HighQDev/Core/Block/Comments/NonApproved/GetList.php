<?php
declare(strict_types=1);

namespace HighQDev\Core\Block\Comments\NonApproved;

use HighQDev\Core\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;

/**
 * Class GetList
 * @package HighQDev\Core\Block\Comments\NonApproved
 */
class GetList extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var SessionFactory
     */
    protected $sessionFactory;

    /**
     * GetList constructor.
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param SessionFactory $sessionFactory
     * @param array $data
     */
    public function __construct(Template\Context $context,
                                CollectionFactory $collectionFactory,
                                SessionFactory $sessionFactory,
                                array $data = [])
    {
        $this->collectionFactory = $collectionFactory;
        $this->sessionFactory = $sessionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return \HighQDev\Core\Model\ResourceModel\Comment\Collection
     */
    public function getNonApprovedComments()
    {
        /**
         * @var $collection \HighQDev\Core\Model\ResourceModel\Comment\Collection
         */
        $collection = $this->collectionFactory->create();
        /**
         * @var $customerSession \Magento\Customer\Model\Session
         */
        $customerSession = $this->sessionFactory->create();
        /**
         * @var $customerId int
         */
        $customerId = (int)$customerSession->getCustomerId();
        $collection->addFieldToSelect(['sku', 'comment_text'])
            ->addFieldToFilter('comment_approved', ['eq' => false])
            ->addFieldToFilter('customer_Id', ['eq' => $customerId]);
        return $collection;
    }

}
