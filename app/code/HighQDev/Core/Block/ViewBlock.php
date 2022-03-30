<?php
declare(strict_types=1);

namespace HighQDev\Core\Block;

use HighQDev\Core\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;

/**
 * Class ViewBlock
 * @package HighQDev\Core\Block
 */
class ViewBlock extends \Magento\Framework\View\Element\Template
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
     * ViewBlock constructor.
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
    public function getApprovedComments()
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
            ->addFieldToFilter('comment_approved', ['eq' => true])
            ->addFieldToFilter('customer_Id', ['eq' => $customerId]);
        return $collection;
    }
}
