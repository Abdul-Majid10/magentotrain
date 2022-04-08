<?php
declare(strict_types=1);

namespace HighQDev\Core\Plugin;

use Magento\Catalog\Model\Product as MagentoProduct;

/**
 * Class Product
 * @package HighQDev\Core\Plugin
 */
class Product
{
    /**
     * @param MagentoProduct $subject
     * @param $result
     * @return string
     */
    public function afterGetSku(MagentoProduct $subject, $result)
    {
        return $result . '-Majid';
    }
}
