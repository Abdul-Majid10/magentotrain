<?php
declare(strict_types=1);

namespace HighQDev\Core\Block;

use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;

/**
 * Class IndexBlock
 * @package HighQDev\Core\Block
 */
class IndexBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var SessionFactory
     */
    protected $customerSessionFactory;

    /**
     * IndexBlock constructor.
     * @param Template\Context $context
     * @param SessionFactory $customerSessionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        SessionFactory $customerSessionFactory,
        array $data = [])
    {
        $this->customerSessionFactory = $customerSessionFactory;
        parent::__construct($context, $data);
    }


    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getLoginMessage()
    {
        $customerSession = $this->customerSessionFactory->create();
        if ($customerSession->isLoggedIn()) {
            return "Welcome " . $customerSession->getCustomer()->getName() . ", Thanks For Login!";
        } else {
            return "This is Guest checkout, Nobody is loggedIn.";
        }
    }
}
