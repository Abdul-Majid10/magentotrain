<?php
declare(strict_types=1);

namespace HighQDev\Core\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;

/**
 * Class IndexBlock
 * @package HighQDev\Core\Block
 */
class IndexBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Session
     */
    protected $custumerSession;

    /**
     * IndexBlock constructor.
     * @param Template\Context $context
     * @param Session $custumerSession
     * @param array $data
     */
    public function __construct(Template\Context $context, Session $custumerSession, array $data = [])
    {
        parent::__construct($context, $data);
        $this->custumerSession = $custumerSession;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getLoginMessage()
    {
        if ($this->custumerSession->isLoggedIn()) {
            return "Welcome " . $this->custumerSession->getCustomer()->getName() . ", Thanks For Login!";
        } else {
            return "This is Guest checkout, Nobody is loggedIn.";
        }
    }
}
