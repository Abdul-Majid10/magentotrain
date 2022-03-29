<?php
declare(strict_types=1);

namespace HighQDev\Core\Block;

use HighQDev\Core\Model\ResourceModel\Comment\CollectionFactory;
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
     * ViewBlock constructor.
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(Template\Context $context,
                                CollectionFactory $collectionFactory,
                                array $data = [])
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Framework\DataObject[]
     */
    public function getApprovedComments()
    {
        $collection = $this->collectionFactory->create();
        $comments = $collection->addFieldToSelect(['sku', 'comment_text'])->addFieldToFilter('comment_approved', ['eq' => true])->getItems();
        return $comments;
    }
}
