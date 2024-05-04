<?php
namespace Cp\Modification\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Quote\Model\QuoteFactory;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Quote\Api\CartManagementInterface;
use Magento\Quote\Api\CartRepositoryInterface;

class Save extends Action
{
    protected $resultJsonFactory;
    protected $checkoutSession;
    protected $quoteFactory;
    protected $customerSession;
    protected $cartManagementInterface;
    protected $quoteRepository;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CheckoutSession $checkoutSession,
        QuoteFactory $quoteFactory,
        CustomerSession $customerSession,
        CartManagementInterface $cartManagementInterface,
        CartRepositoryInterface $quoteRepository
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->checkoutSession = $checkoutSession;
        $this->quoteFactory = $quoteFactory;
        $this->customerSession = $customerSession;
        $this->cartManagementInterface = $cartManagementInterface;
        $this->quoteRepository = $quoteRepository;
    }

    public function execute()
    {   
      
        $result = $this->resultJsonFactory->create();

        
            $jsonData = $this->getRequest()->getContent();
            $data = json_decode($jsonData, true);

            if (isset($data['value'])) {
                $shipValue = $data['value'];
            } 
           

            $customer = $this->customerSession->getCustomerDataObject();
            $customerId = $customer->getId();
            
           
            $quoteId = $this->cartManagementInterface->createEmptyCartForCustomer($customerId);
            $quote = $this->quoteRepository->getActive($quoteId);

            $quote->setData('shipping_type', $shipValue);
            $this->quoteRepository->save($quote);

            $result->setData([
                'success' => true,
                'message' => 'Shipping type updated successfully.'
            ]);
        

        return $result;
    }
}
