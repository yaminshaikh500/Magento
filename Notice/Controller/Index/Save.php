<?php
 
namespace Cp\Notice\Controller\Index;
 
use Cp\Notice\Model\NoticeFactory;
use Magento\Customer\Model\Session as CustomerSession;

 
class Save extends \Magento\Framework\App\Action\Action
{
    protected $resultJsonFactory;
    protected $quoteFactory;
    protected $checkoutSession;
    protected $noticeFactory;
    protected $customerSession;

 
    public function __construct(
        NoticeFactory $noticeFactory,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        CustomerSession $customerSession,

    ) {
        parent::__construct($context);
 
        $this->noticeFactory = $noticeFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerSession = $customerSession;

    }
 
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $jsonData = $this->getRequest()->getContent();
        $data = json_decode($jsonData, true);
 
        $checks =$data['value'];
        $customerId = $this->customerSession->getCustomerId();
  
        $getNotice = $this->noticeFactory->create();
        $getNotice->setNotice($checks);
        $getNotice->setCustomerId($customerId);
        $getNotice->save();
 
        return $result->setData([
            'checkbox' => $checks,
            'message' => 'checks exists'
        ]);
    }
}
 