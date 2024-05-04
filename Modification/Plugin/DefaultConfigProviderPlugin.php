<?php


namespace Cp\Modification\Plugin;
class DefaultConfigProviderPlugin

{

  protected $checkoutSession;


  public function __construct(

    \Magento\Checkout\Model\Session $checkoutSession

  ) {

    $this->checkoutSession   = $checkoutSession;

  }


  public function afterGetConfig(

    \Magento\Checkout\Model\DefaultConfigProvider $subject,

    $output

  ) {

    $quote = $this->checkoutSession->getQuote();
    $ship = $quote->getShippingType();


    $output['shipping_type'] = $ship;
    $output['residential'] =(int)$quote->getResidentialShip();
    $output['liftgate'] = (int)$quote->getLiftgateShip();
    $output['delivery'] = (int)$quote->getDeliveryShip();



    return $output;

  }


   

}


