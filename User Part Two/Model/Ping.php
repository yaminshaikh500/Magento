<?php

namespace Cp\User\Model;

use Magento\Customer\Model\CustomerFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
    public function __construct(CustomerFactory $customerFactory)
    {
        $this->customerFactory = $customerFactory;
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
        $customerCollection = $this->customerFactory->create()->getCollection();
        $customerIds = [];
        foreach ($customerCollection as $customer) {
            $customerIds[] = $customer->getId();
        }
        $output->writeln('Customer IDs: ' . implode(', ', $customerIds));
    }
}
