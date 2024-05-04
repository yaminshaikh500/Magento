<?php

namespace Cp\Modification\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Exception\LocalizedException;

class Methods extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;

    /**
     * Constructor
     *
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param CheckoutSession $checkoutSession
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        CheckoutSession $checkoutSession
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * Execute action based on request
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        try {
            $jsonData = $this->getRequest()->getContent();
            $data = json_decode($jsonData, true);

            if (!isset($data['value'])) {
                throw new LocalizedException(__('Required parameter "value" is missing.'));
            }

            $residential = $data['value'];

            $quote = $this->checkoutSession->getQuote();
            $quote->setResidentialShip($residential);
            if($residential == '0')
            {
                $quote->setLiftgateShip(0);
                $quote->setDeliveryShip(0);
            }
            else{
                $quote->setLiftgateShip(1);
                $quote->setDeliveryShip(1);
            }
            $quote->save();

            return $result->setData(['success' => true, 'message' => 'Residential shipping updated.']);
        } catch (\Exception $e) {
            return $result->setData(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
