<?php
declare(strict_types=1);

namespace HighQDev\Core\Block\Comments\Approved;

use Magento\Framework\View\Element\Template;

/**
 * Class Content
 * @package HighQDev\Core\Block\Comments\Approved
 */
class Content extends Template
{
    /**
     * Content constructor.
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }
}
