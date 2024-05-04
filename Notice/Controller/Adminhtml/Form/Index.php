<?php
namespace Cp\Notice\Controller\Adminhtml\Form;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	const ADMIN_RESOURCE = 'Cp_Notice::Notifcation_menu';

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();

		$resultPage->setActiveMenu('Cp_Notice::Notification_list');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Popup'));

		return $resultPage;
	}
}