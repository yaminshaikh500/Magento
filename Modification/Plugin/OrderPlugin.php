<?php
 
namespace Cp\Modification\Plugin;
 
use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
 
class OrderPlugin
{
    /**
     * Order Extension Factory
     *
     * @var OrderExtensionFactory
     */
    protected $extensionFactory;
 
    /**
     * Constructor
     *
     * @param OrderExtensionFactory $extensionFactory
     */
    public function __construct(OrderExtensionFactory $extensionFactory)
    {
        $this->extensionFactory = $extensionFactory;
    }
 
    /**
     * After Get plugin
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $order
     * @return OrderInterface
     */
    public function afterGet(OrderRepositoryInterface $subject, OrderInterface $order)
    {
        $extensionAttributes = $order->getExtensionAttributes() ?: $this->extensionFactory->create();
 
        $extensionAttributes->setShippingType($order->getShippingType());
        $extensionAttributes->setResidentialShip($order->getResidentialShip());
        $extensionAttributes->setLiftgateShip($order->getLiftgateShip());
        $extensionAttributes->setDeliveryShip($order->getDeliveryShip());
 
        $order->setExtensionAttributes($extensionAttributes);
 
        return $order;
    }
 
    /**
     * After Get List plugin
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderSearchResultInterface $searchResult
     * @return OrderSearchResultInterface
     */
    public function afterGetList(OrderRepositoryInterface $subject, OrderSearchResultInterface $searchResult)
    {
        $orders = $searchResult->getItems();
        foreach ($orders as $order) {
            $this->afterGet($subject, $order);
        }
        return $searchResult;
    }
 
    /**
     * Before Save plugin
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $order
     * @return array
     */
    public function beforeSave(OrderRepositoryInterface $subject, OrderInterface $order)
    {
        $extensionAttributes = $order->getExtensionAttributes();
        if ($extensionAttributes !== null) {
            $order->setShippingType($extensionAttributes->getShippingType());
            $order->setResidentialShip($extensionAttributes->getResidentialShip());
            $order->setLiftgateShip($extensionAttributes->getLiftgateShip());
            $order->setDeliveryShip($extensionAttributes->getDeliveryShip());
        }
 
        return [$order];
    }
}
 