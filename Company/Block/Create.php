<?php

namespace Cp\Company\Block;

use Magento\Framework\View\Element\Template\Context;

class Create extends \Magento\Framework\View\Element\Template
{

    protected $customerSession;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
   
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->customerSession = $customerSession;
    }

    public function getWelcomeText()
    {
        return 'This is Block';
    }
    public function getIds()
    {
       $customer = $this->customerSession->getCustomer()->getId();
       return $customer;
    }
   
}
