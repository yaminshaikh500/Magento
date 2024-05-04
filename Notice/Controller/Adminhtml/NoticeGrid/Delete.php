<?php
namespace Cp\Notice\Controller\Adminhtml\NoticeGrid;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Cp\Notice\Model\NoticeFactory;

class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Cp_Notice::Notifcation_menu';

    protected $noticeFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        NoticeFactory $noticeFactory,
    ) {
        parent::__construct($context);
        $this->noticeFactory = $noticeFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('notice_id');
       // $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                
                $pageModel = $this->noticeFactory->create()->load($id);
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
