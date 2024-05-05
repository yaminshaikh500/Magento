<?php
namespace Cp\User\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Cp\User\Model\CpAddressFactory;
use Magento\Framework\App\RequestInterface;

class UserRegisterSuccess implements ObserverInterface
{
    protected $customerRepository;
    protected $cpaddressFactory;
    protected $request;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        CpAddressFactory $cpaddressFactory,
        RequestInterface $request
    ) {
        $this->customerRepository = $customerRepository;
        $this->cpaddressFactory = $cpaddressFactory;
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        
        $street = $this->request->getParam('kstreet');
        $city = $this->request->getParam('kcity');
        $region = $this->request->getParam('kregion');
        $postcode = $this->request->getParam('kpostcode');
        $country = $this->request->getParam('kcountry');
        $customer = $observer->getEvent()->getCustomer();
        $customerID = $customer->getId();

        
        $this->saveToCustomTable($street, $city, $region, $postcode, $country, $customerID);
    }

    protected function saveToCustomTable($street, $city, $region, $postcode, $country, $customerID)
    {
        $addressModel = $this->cpaddressFactory->create();
        
        $addressModel->setStreet($street);
        $addressModel->setCity($city);
        $addressModel->setRegion($region);
        $addressModel->setPostcode($postcode);
        $addressModel->setCountry($country);
        // print_r($addressModel);
        // die;
       $addressModel->setCustomerId($customerID);
        $addressModel->save();
    }
    
    
}