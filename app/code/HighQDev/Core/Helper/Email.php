<?php

declare(strict_types=1);

namespace HighQDev\Core\Helper;

use Magento\Customer\Model\SessionFactory;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var SessionFactory
     */
    public $sessionFactory;
    /**
     * @var StateInterface
     */
    protected $inlineTranslation;
    /**
     * @var Escaper
     */
    protected $escaper;
    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    /**
     * @var CollectionFactory
     */
    protected $orderCollectionFactory;
    /**
     * @var String
     */
    private $customerName = "Guest Customer";
    /**
     * @var String
     */
    private $customerEmail = "Guest Customer";
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * Email constructor.
     * @param Context $context
     * @param StateInterface $inlineTranslation
     * @param Escaper $escaper
     * @param TransportBuilder $transportBuilder
     * @param CollectionFactory $orderCollectionFactory
     * @param ResourceConnection $resourceConnection
     * @param SessionFactory $sessionFactory
     */
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        CollectionFactory $orderCollectionFactory,
        ResourceConnection $resourceConnection,
        SessionFactory $sessionFactory
    )
    {
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->logger = $context->getLogger();
        $this->resourceConnection = $resourceConnection;
        $this->sessionFactory = $sessionFactory;
        parent::__construct($context);
    }

    public function sendEmail()
    {
        try {
            /**
             * @var $collection \Magento\Sales\Model\ResourceModel\Order\Collection
             */
            $collection = $this->orderCollectionFactory->create();
            $sales_order_payment_table = $this->resourceConnection->getTableName("sales_order_payment");
            $collection->getSelect()
                ->join(
                    ['payment' => $sales_order_payment_table],
                    'main_table.entity_id= payment.parent_id',
                    [
                        'payment_method' => 'payment.method'
                    ]
                )->where("main_table.status= 'complete'")
                ->where($this->getCutomerCondition())
                ->where("payment.method= 'cashondelivery'");

            $ordersCount = $collection->getSize();
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('New Order'),
                'email' => $this->escaper->escapeHtml('store@highqdev.com'),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('order_placed_email_template')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'totelOrders' => $ordersCount,
                    'customerName' => $this->customerName,
                    'customerEmail' => $this->customerEmail,
                ])
                ->setFrom($sender)
                ->addTo('majid@highqdev.com')
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCutomerCondition()
    {
        /**
         * @var $session \Magento\Customer\Model\Session
         */
        $session = $this->sessionFactory->create();
        if ($session->isLoggedIn()) {
            $this->customerName = $session->getCustomer()->getName();
            $this->customerEmail = $session->getCustomer()->getEmail();
            return "main_table.customer_id= " . $session->getCustomer()->getId();
        } else {
            return "main_table.customer_id IS NULL";
        }
    }
}
