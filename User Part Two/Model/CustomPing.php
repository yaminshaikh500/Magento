<?php

namespace Cp\User\Model;

use Magento\Customer\Model\CustomerFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Cp\User\Helper\EmailHelper;


class CustomPing extends Command
{
    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * Constructor.
     *
     * @param CustomerFactory $customerFactory
     */
    public function __construct(
    EmailHelper $helper,
    )
    {
        $this->helper = $helper;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('cp:ping')
             ->setDescription('Ping For get Customer Ids');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // $customerCollection = $this->customerFactory->create()->getCollection();
    

        // foreach ($customerCollection as $customer) {
        //     $customerId = $customer->getId();
        //     //   $customerName = $customer->getName();
        //     // print_r($customerId) . "<br>";
        // }
        $this->helper->getData();

        $output->writeln('hello');
        return 1;

    }
}
