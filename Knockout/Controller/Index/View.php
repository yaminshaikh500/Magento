<?php
namespace Cp\Knockout\Controller\Index;
 
class View extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ){
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
 
    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}
 