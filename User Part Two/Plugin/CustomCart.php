<?php

namespace Cp\User\Plugin;
 
class CustomCart
{
    protected $cacheTypeList;
 
    public function __construct(
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
    ) {
        $this->cacheTypeList = $cacheTypeList;
    }
 
    public function afterGetFinalPrice(
        \Magento\Catalog\Model\Product $subject,
        $result,
        $qty = null
    ) {
        $product = $subject->load($subject->getId());
       
        $priceType = (float)$product->getData('custom_price_type');
        $prices = (float)$product->getData('custom_price');
 
        if ((float)$result > 0 && $prices > 0 && in_array($priceType,[0,1])) {
            if ($priceType == 0) {
                $result = (float)$prices; 
                
            } elseif ($priceType == 1) {
             
                $discount = $prices / 100;
                $result = (float)($result- ($result * $discount));
            }
        }
       
$product->setFinalPrice($result);

$product->setSpecialPrice();
 
                $product->save();
        return $result; 
    }}
 