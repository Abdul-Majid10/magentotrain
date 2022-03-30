<?php
declare(strict_types=1);

namespace HighQDev\Core\Model;
/**
 * Class Comment
 * @package HighQDev\Core\Model
 */
class Comment extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'highqdev_core_comment';
    const ENTITY_ID = 'entity_id';
    const SKU = 'sku';
    const COMMENT_TEXT = 'comment_text';
    const COMMENT_APPROVED = 'comment_approved';
    const CUSTOMER_ID = 'customer_id';

    /**
     * @var string
     */
    protected $_cacheTag = 'highqdev_core_comment';
    /**
     * @var string
     */
    protected $_eventPrefix = 'highqdev_core_comment';

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @return String
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * @return String
     */
    public function getCommentText()
    {
        return $this->getData(self::COMMENT_TEXT);
    }

    /**
     * @return boolean
     */
    public function getCommentApproved()
    {
        return $this->getData(self::COMMENT_APPROVED);
    }

    /**
     * @return String
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @param int $entityId
     * @return Comment
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @param $sku
     * @return Comment
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * @param $comment_text
     * @return Comment
     */
    public function setCommentText($comment_text)
    {
        return $this->setData(self::COMMENT_TEXT, $comment_text);
    }

    /**
     * @param $customer_id
     * @return Comment
     */
    public function setCustomerId($customer_id)
    {
        return $this->setData(self::CUSTOMER_ID, $customer_id);
    }

    /**
     * @param $comment_approved
     * @return Comment
     */
    public function setCommentApproved($comment_approved)
    {
        return $this->setData(self::COMMENT_APPROVED, $comment_approved);
    }

    protected function _construct()
    {
        $this->_init('HighQDev\Core\Model\ResourceModel\Comment');
    }

}
