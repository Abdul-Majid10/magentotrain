<?php

namespace HighQDev\Core\Model\ResourceModel;

/**
 * Class Comment
 * @package HighQDev\Core\Model\ResourceModel
 */
class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Comment constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('comment', 'entity_id');
    }

}
