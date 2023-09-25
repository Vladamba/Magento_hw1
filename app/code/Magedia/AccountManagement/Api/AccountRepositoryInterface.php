<?php

namespace Magedia\AccountManagement\Api;

use Magedia\AccountManagement\Api\Data\AccountInterface;

interface AccountRepositoryInterface
{
    /**
     * @param int $count
     * @return AccountInterface[]
     */
    public function getAccounts(int $count);

    /**
     * @param int $customerId
     * @param string $ipAddress
     * @return AccountInterface
     */
    public function save(int $customerId, string $ipAddress): AccountInterface;

    /**
     * @param int $customerId
     * @return void
     */
    public function delete(int $customerId): void;

    /**
     * @param string $ipAddress
     * @return bool
     */
    public function checkIp(string $ipAddress): bool;
}
