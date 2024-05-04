<?php

namespace Cp\Company\Block;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\UrlInterface;


class Index extends \Magento\Framework\View\Element\Template
{
    protected $customerFactory; 
    protected $urlBuilder;
    

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CustomerFactory $customerFactory,
        UrlInterface $urlBuilder,
        \Magento\Authorization\Model\UserContextInterface $userContext,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->customerFactory = $customerFactory;
        $this->urlBuilder = $urlBuilder;
        $this->userContext = $userContext;
        $this->customerSession = $customerSession;

    }
   
    public function getWelcomeText()
    {
        return 'This is Block';
    }

    public function Display()
    {
        // var_dump($this->userContext->getUserId());
       $customerId =$this->customerSession->getCustomer()->getId();
          
        if ($customerId) {
            $model = $this->customerFactory->create();

            $collection = $model->getCollection()->addFieldToFilter('parent_id', $customerId);

            foreach ($collection as $data) {
                echo "<tr>";
                echo "<td>".$data->getParentId()."</td>";
                echo "<td>".$data->getFirstname()."</td>";
                echo "<td>".$data->getLastname()."</td>";
                echo "<td>".$data->getEmail()."</td>";
                echo "<td>".$data->getCreatedAt()."</td>";
                echo "<td>".$data->getUpdatedAt()."</td>";
                echo "<td><a href='".$this->urlBuilder->getUrl('company/staff/create', ['entity_id' => $data->getId()])."'>Edit</a></td>";
                echo "<td><button onclick=\"window.location='".$this->urlBuilder->getUrl('company/staff/delete', ['entity_id' => $data->getId()])."'\">Delete</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found. Please specify a customer ID.</td></tr>";
        }
    }
}
