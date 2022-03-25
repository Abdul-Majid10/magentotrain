<?php

namespace HighQDev\Core\Model;
/**
 * Class Comment
 * @package HighQDev\Core\Model
 */
class Comment extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'highqdev_core_post';

    /**
     * @var string
     */
    protected $_cacheTag = 'highqdev_core_post';

    /**
     * @var string
     */
    protected $_eventPrefix = 'highqdev_core_post';

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    protected function _construct()
    {
        $this->_init('HighQDev\Core\Model\ResourceModel\Comment');
    }
}
