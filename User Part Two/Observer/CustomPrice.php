<?php
namespace Cp\User\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomPrice implements ObserverInterface
{
    protected $productRepository;

    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $item = $observer->getEvent()->getData('quote_item');
        
        $product = $item->getProduct();
        
        if ($customPrice = $product->getData('custom_price')) 
        {
            $defaultPrice = $product->getFinalPrice();
            
            $priceType = $product->getCustomPriceType();
            
            if ($priceType == 'fixed') {
                $newPrice = $defaultPrice + $customPrice;
            } elseif ($priceType == 'percentage') {
                $price = $defaultPrice * $customPrice / 100;
                $newPrice = $defaultPrice - $price;
            } else {
                $newPrice = $defaultPrice;
            }
            
            $item->setCustomPrice($newPrice);
            $item->setOriginalCustomPrice($newPrice);
            
            $item->getProduct()->setIsSuperMode(true);
        }
    }
}
