<?php

namespace Magedia\ManageCustomers\Api;

interface CustomerRepositoryInterface
{
    /**
     * @param int $count
     * @return \Magedia\ManageCustomers\Api\Data\CustomerInterface[]
     */
    public function getCustomers(int $count);


    /**
     * @param int $id
     * @return bool
     */
    public function deleteCustomerById(int $id): bool;
}
