<?php

declare(strict_types=1);

namespace Magedia\AccountManagement\Observer;

use Magedia\AccountManagement\Model\AccountRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\App\ResponseInterface;

class Login implements ObserverInterface
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
     * @var ResponseInterface $response
     */
    private $response;

    /**
     * @param AccountRepository $accountRepository
     * @param RemoteAddress $remoteAddress
     * @param ResponseInterface $response
     */
    public function __construct(
        AccountRepository $accountRepository,
        RemoteAddress     $remoteAddress,
        ResponseInterface $response)
    {
        $this->accountRepository = $accountRepository;
        $this->remoteAddress = $remoteAddress;
        $this->response = $response;
    }

    /**
     * @param Observer $observer
     * @return void
     * @throws AlreadyExistsException
     */
    public function execute(Observer $observer): void
    {
        $customer = $observer->getData('customer');
        $customerId = $customer->getId();
        $ipAddress = $this->remoteAddress->getRemoteAddress();

        if ($this->accountRepository->checkIp($ipAddress)) {
            $this->response->setRedirect('/', 301)->sendResponse();
            die();
        } else {
            $this->accountRepository->save((int)$customerId, $ipAddress);
        }
    }
}
