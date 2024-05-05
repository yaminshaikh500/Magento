<?php
namespace Cp\User\Observer;

use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Message\ManagerInterface;
use Psr\Log\LoggerInterface;


class Event implements \Magento\Framework\Event\ObserverInterface
{
    protected $logger;
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var RedirectInterface
     */
    protected $redirect;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    public function __construct(
        \Magento\Framework\App\Request\Http $request,
        \Magento\Customer\Model\Session $customerSession,
        CustomerRepositoryInterface $customerRepository,
        RedirectInterface $redirect,
        ManagerInterface $messageManager,
        LoggerInterface $logger
    ) {
        $this->request = $request; 
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        $this->redirect = $redirect;
        $this->messageManager = $messageManager;
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // echo $this->request->getRouteName() . "_" . $this->request->getControllerName() . "_" . $this->request->getActionName();
//         if ($this->customerSession->isLoggedIn()) {
            
//             $customerId = $this->customerSession->getCustomerId();
//             $attribute = $this->customerSession->getCustomer();

//             $customer = $attribute->getCustomerListingAllow();

           
//             echo '<br/>$customerId : ' . $customerId;
//             echo '<br/>attribute value : ' . $customer;
// echo $info;die;

//             if($info == "catalog_category_view" && $customer != 1)
//             { 
//                echo "hello";
               
//                 $this->messageManager->addErrorMessage(__('Your account is not approved. Please contact admin for assistance.'));
//                // return $this->accountRedirect->getRedirect();
//             }   
//             else {
                
//                 echo "hello1";
             
//             }
//         }
        
        
    }
}
