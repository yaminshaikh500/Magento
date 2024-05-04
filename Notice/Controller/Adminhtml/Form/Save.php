<?php
declare(strict_types=1);

namespace Cp\Notice\Controller\Adminhtml\Form;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Cp\Notice\Model\NotificationFactory;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var NotificationFactory
     */
    private $notificationFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param NotificationFactory $notificationFactory
     */
    public function __construct(
        Context $context,
        NotificationFactory $notificationFactory
    ) {
        parent::__construct($context);
        $this->notificationFactory = $notificationFactory;
    }

    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        // print_r($data);
        if ($data) {
            $id = !empty($data['notification_id']) ? (int)$data['notification_id'] : null;
            $model = $this->notificationFactory->create();

            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->messageManager->addErrorMessage(__('This notification no longer exists.'));
                    return $resultRedirect->setPath('note/grid/index');
                }
            }

            $model->setTitle($data['title']);
                $model->setDescription($data['description']);
                $model->setStatus($data['status']);

                $model->setCustomerGroup($data['customer_group'][0]);


            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Notification data has been saved.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while saving the notification data.'));
            }

            $this->_getSession()->setFormData($data);
        }

        return $resultRedirect->setPath('note/grid/index');
    }
}
