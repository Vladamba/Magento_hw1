<?php

declare(strict_types=1);

namespace Magedia\AccountManagement\Plugin;

use Magedia\AccountManagement\Model\AccountRepository;
use Magento\Customer\Model\AccountManagement;
use Magento\Customer\Model\Customer;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class Login
{
    /**
     * @var AccountRepository $accountRepository
     */
    private $accountRepository;

    /**
     * @var RemoteAddress $remoteAddress
     */
    private $remoteAddress;


    /**
     * @param AccountRepository $accountRepository
     * @param RemoteAddress $remoteAddress
     */
    public function __construct(
        AccountRepository $accountRepository,
        RemoteAddress     $remoteAddress)
    {
        $this->accountRepository = $accountRepository;
        $this->remoteAddress = $remoteAddress;
    }

    /**
     * @param AccountManagement $subject
     * @param Customer $result
     * @return Customer
     * @throws AlreadyExistsException
     * @throws \Magento\Framework\Exception\Plugin\AuthenticationException
     */
    public function afterAuthenticate(AccountManagement $subject, $result)
    {
        $ipAddress = $this->remoteAddress->getRemoteAddress();

        if ($this->accountRepository->checkIp($ipAddress)) {
            throw new \Magento\Framework\Exception\Plugin\AuthenticationException(__('Customer ip address is in the table'));
        }

        $customerId = $result->getId();
        $this->accountRepository->save((int)$customerId, $ipAddress);

        return $result;
    }
}
