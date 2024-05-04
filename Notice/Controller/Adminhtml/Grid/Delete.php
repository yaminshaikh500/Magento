<?php
namespace Cp\Notice\Controller\Adminhtml\Grid;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Cp\Notice\Model\NotificationFactory;

class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Cp_Notice::Notifcation_menu';

    protected $notificationFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        NotificationFactory $notificationFactory,
    ) {
        parent::__construct($context);
        $this->notificationFactory = $notificationFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('notification_id');
       // $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                
                $pageModel = $this->notificationFactory->create()->load($id);
                $pageModel->delete();
                
                $this->messageManager->addSuccessMessage(__('The details has been deleted.'));
            //    return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                //return $resultRedirect->setPath('*/*/edit', ['user_id' => $id]);
            }
        }
        
        $this->messageManager->addErrorMessage(__('We can\'t find a details to delete.'));
       // return $resultRedirect->setPath('*/*/');
    }
}
