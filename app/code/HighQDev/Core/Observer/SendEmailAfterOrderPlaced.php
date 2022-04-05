<?php
declare(strict_types=1);

namespace HighQDev\Core\Observer;

use HighQDev\Core\Helper\Email;
use Magento\Framework\Event\ObserverInterface;

class SendEmailAfterOrderPlaced implements ObserverInterface
{
    /**
     * @var Email
     */
    private $helperEmail;

    /**
     * SendEmailAfterOrderPlaced constructor.
     * @param Email $helperEmail
     */
    public function __construct(
        Email $helperEmail
    )
    {
        $this->helperEmail = $helperEmail;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        return $this->helperEmail->sendEmail();
    }
}
