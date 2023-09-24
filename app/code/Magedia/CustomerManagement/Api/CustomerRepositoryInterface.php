<?php

namespace Magedia\CustomerManagement\Api;

interface CustomerRepositoryInterface
{
    /**
     * @param int $count
     * @return \Magedia\CustomerManagement\Api\Data\CustomerInterface[]
     */
    public function getCustomers(int $count);


    /**
     * @param int $id
     * @return bool
     */
    public function deleteCustomerById(int $id): bool;
}
