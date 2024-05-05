<?php

namespace Cp\User\Plugin;

use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderExtensionInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

/**
 * Class OrderRepositoryPlugin
 */
class OrderRepositoryPlugin {
  
  /**
   * Order Comment field name
   */
  const FIELD_NAME = 'custom_attribute';

  /**
   * Order Extension Factory
   *
   * @var OrderExtensionFactory
   */
  protected $extensionFactory;

  /**
   * OrderRepositoryPlugin constructor
   *
   * @param OrderExtensionFactory $extensionFactory
   */
  public function __construct(OrderExtensionFactory $extensionFactory) {
    $this->extensionFactory = $extensionFactory;
  }

  /**
   * @param OrderRepositoryInterface $subject
   * @param OrderInterface $order
   * @return void
   */
  public function afterGet(OrderRepositoryInterface $subject, OrderInterface $order) {
    $orderComment = $order->getData(self::FIELD_NAME);
    $extensionAttributes = $order->getExtensionAttributes();
    $extensionAttributes = $extensionAttributes ? $extensionAttributes : $this->extensionFactory->create();
    $extensionAttributes->setCustomAttribute($orderComment ?? 'hello');
    $order->setExtensionAttributes($extensionAttributes);
    return $order;
  }

  /**
   * @param OrderRepositoryInterface $subject
   * @param OrderSearchResultInterface $searchResult
   * @return void
   */
  public function afterGetList(OrderRepositoryInterface $subject, OrderSearchResultInterface $searchResult) {
    $orders = $searchResult->getItems();
    foreach ($orders as &$order) {
      $order = $this->afterGet($subject, $order);
    }
    return $searchResult;
  }

  /**
   * @param OrderRepositoryInterface $subject
   * @param OrderInterface $order
   * @return void
   */
  public function beforeSave(OrderRepositoryInterface $subject, OrderInterface $order) {
    $extensionAttributes = $order->getExtensionAttributes() ?: $this->extensionFactory->create();
    if ($extensionAttributes !== null && $extensionAttributes->getOrderComment() !== null) {
      $comment = $extensionAttributes->getOrderComment();
      $order->setOrderComment($comment);
    }
    return [$order];
  }

}