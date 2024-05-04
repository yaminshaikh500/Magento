<?php

namespace Cp\Company\Controller\Staff;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\CustomerFactory;

class Delete extends Action
{
    protected $customerFactory;
    protected $message1;
    public function __construct(
        Context $context,
        CustomerFactory $customerFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->customerFactory = $customerFactory;
        $this->message1= $messageManager;
        parent::__construct($context);
    }
    

    public function execute()
{
    $id = $this->getRequest()->getparam("parent_id");
    $del = $this->customerFactory->create()->load($id);
    $del->delete();
    $this->message1->addSuccess(__('Staff data has been deleted.'));
    $this->_redirect('company/staff/index');
}





}

