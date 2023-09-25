<?php

declare(strict_types=1);

namespace Magedia\AccountManagement\Model;

use Magedia\AccountManagement\Api\AccountRepositoryInterface;
use Magedia\AccountManagement\Api\Data\AccountInterface;
use Magedia\AccountManagement\Model\AccountFactory;
use Magedia\AccountManagement\Model\ResourceModel\Account as AccountResource;
use Magedia\AccountManagement\Model\ResourceModel\Account\Collection as AccountCollection;
use Magedia\AccountManagement\Model\ResourceModel\Account\CollectionFactory as AccountCollectionFactory;

class AccountRepository implements AccountRepositoryInterface
{
    /**
     * @var AccountResource $accountResource
     */
    private $accountResource;

    /**
     * @var AccountFactory $accountFactory
     */
    private $accountFactory;

    /**
     * @var AccountCollectionFactory $accountCollectionFactory
     */
    private $accountCollectionFactory;

    /**
     * @param AccountResource $accountResource
     * @param AccountFactory $postFactory
     * @param AccountCollectionFactory $postCollectionFactory
     */
    public function __construct(
        AccountResource          $accountResource,
        AccountFactory           $accountFactory,
        AccountCollectionFactory $accountCollectionFactory,
    )
    {
        $this->accountResource = $accountResource;
        $this->accountFactory = $accountFactory;
        $this->accountCollectionFactory = $accountCollectionFactory;
    }

    /**
     * @param int $count
     * @return AccountInterface[]
     */
    public function getAccounts(int $count)
    {
        $collection = $this->accountCollectionFactory->create();
        $collection->setPageSize($count);

        /**
         * @var AccountInterface[] $array
         */
        $array = $collection->getItems();
        return $array;
    }

    /**
     * @param int $customerId
     * @param string $ipAddress
     * @return AccountInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(int $customerId, string $ipAddress): AccountInterface
    {
        $collection = $this->accountCollectionFactory->create();
        $id = 1;
        foreach ($collection as $c) {
            if ($c->getId() > $id) {
                $id = $c->getId();
            }
        }

        /**
         * @var AccountInterface $account
         */
        $account = $this->accountFactory->create();
        $account->setId($id);
        $account->setCustomerId($customerId);
        $account->setIpAddress($ipAddress);

        $this->accountResource->save($account);
        return $account;
    }

    /**
     * @param int $customerId
     * @return void
     * @throws \Exception
     */
    public function delete(int $customerId): void
    {
        $collection = $this->accountCollectionFactory->create();
        foreach ($collection as $c) {
            if ($c->getId() === $customerId) {
                /**
                 * @var AccountInterface $account
                 */
                $account = $this->accountFactory->create();
                $account->setCustomerId($customerId);
                $this->accountResource->delete($account);
            }
        }
    }

    /**
     * @param string $ipAddress
     * @return bool
     */
    public function checkIp(string $ipAddress): bool
    {
        $collection = $this->accountCollectionFactory->create();
        foreach ($collection as $c) {
            if ($c->getIpAddress() === $ipAddress) {
                return true;
            }
        }
        return false;
    }
}
