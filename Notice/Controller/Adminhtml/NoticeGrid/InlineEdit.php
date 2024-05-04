<?php

namespace Cp\Notice\Controller\Adminhtml\NoticeGrid;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Cp\Notice\Model\NoticeFactory;

class InlineEdit extends \Magento\Backend\App\Action
{
    protected $jsonFactory;
    private $notificationFactory;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        NoticeFactory $noticeFactory,
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->noticeFactory = $noticeFactory;
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
//         $writer = new \Laminas\Log\Writer\Stream(BP . '/var/log/custom.log');
// $logger = new  \Laminas\Log\Logger();
// $logger->addWriter($writer);
// $logger->info('text message');


        if ($this->getRequest()->getParam('isAjax'))
        {
            $postItems = $this->getRequest()->getParam('items', []);
            
            if (!count($postItems))
            {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            }
            else
            {
                foreach ($postItems as $id => $data)
                {
                    $model = $this->noticeFactory->create();
                    $model = $model->load($id);
                    $model->setData($data);
                    $model->save();
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }  
}
