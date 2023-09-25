<?php

declare(strict_types=1);

namespace Magedia\AccountManagement\Observer;

use Magedia\AccountManagement\Model\AccountRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Logout implements ObserverInterface
{
    /**
     * @var AccountRepository $accountRepository
     */
    private $accountRepository;

    /**
     * @param AccountRepository $accountRepository
     */
    public function __construct(
        AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
    public function execute(Observer $observer)
    {
        $customer = $observer->getData('customer');
        $customerId = $customer->getId();

        $this->accountRepository->delete((int)$customerId);
    }
}
