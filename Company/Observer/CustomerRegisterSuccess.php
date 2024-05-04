<?php
namespace Cp\Company\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\AddressFactory ;
use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Session;


class CustomerRegisterSuccess implements ObserverInterface
{
    protected $customerRepository;
    protected $addressFactory;
    protected $request;
    protected $customerSession;


    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        AddressFactory $addressFactory,
        RequestInterface $request,
        Session $customerSession

    ) {
        $this->customerRepository = $customerRepository;
        $this->addressFactory = $addressFactory;
        $this->customerSession = $customerSession;
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {

        $customer = $observer->getEvent()->getCustomer();
        $customerID = $customer->getId();
        $firstname = $this->request->getParam('firstname');
        $lastname = $this->request->getParam('lastname');
        $prefix = $this->request->getParam('nameprefix');
        $suffix = $this->request->getParam('namesuffix');
        $initial = $this->request->getParam('initial');
        $company = $this->request->getParam('company');
        $street = $this->request->getParam('street');
        $country = $this->request->getParam('country_id');
        if($this->request->getParam('region_id'))
        {
            $state = $this->request->getParam('region_id');    
        }
        else
        {
            $state = $this->request->getParam('region');
        }
        $city = $this->request->getParam('city');
        $pincode = $this->request->getParam('pincode');
        $phone = $this->request->getParam('phone');
        $vat = $this->request->getParam('vat');
        $customerType = $this->request->getParam('customer_type'); 
    
        
        if ($customerType == 1) {
            $this->saveToCustomTable($firstname, $lastname, $prefix, $suffix, $initial, $company, $street, $country, $state, $city, $pincode, $phone, $vat, $customerID);
        }
    }
    
    protected function saveToCustomTable($firstname, $lastname, $prefix, $suffix, $initial, $company, $street, $country, $state, $city, $pincode, $phone, $vat, $customerID)
    {
        $addressModel = $this->addressFactory->create();
        $addressModel->setFirstname($firstname);
        $addressModel->setLastname($lastname);
        $addressModel->setParentId($customerID);
        $addressModel->setPrefix($prefix);
        $addressModel->setSuffix($suffix);
        $addressModel->setMiddlename($initial);
        $addressModel->setCompany($company);
        $addressModel->setStreet($street);
        $addressModel->setCountryId($country);
        $addressModel->setRegion($state);
        $addressModel->setCity($city);
        $addressModel->setPostcode($pincode);
        $addressModel->setTelephone($phone);
        $addressModel->setVatId($vat);
    
        $addressModel->save();
    }
       
    
}