<?php
declare(strict_types=1);

namespace HighQDev\Core\Model\ResourceModel\Comment;

/**
 * Class Collection
 * @package HighQDev\Core\Model\ResourceModel\Comment
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'highqdev_core_comment_collection';
    protected $_eventObject = 'comment_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('HighQDev\Core\Model\Comment', 'HighQDev\Core\Model\ResourceModel\Comment');
    }
}
