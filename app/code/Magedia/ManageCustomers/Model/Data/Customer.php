<?php

namespace Magedia\ManageCustomers\Model\Data;

use Magedia\ManageCustomers\Api\Data\CustomerInterface;
use Magento\Framework\DataObject;

class Customer extends DataObject implements CustomerInterface
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getData('id');
    }

    /**
     * @param int $id
     * @return CustomerInterface
     */
    public function setId(int $id): CustomerInterface
    {
        return $this->setData('id', $id);
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->getData('firstname');
    }

    /**
     * @param string $firstname
     * @return CustomerInterface
     */
    public function setFirstname(string $firstname): CustomerInterface
    {
        return $this->setData('firstname', $firstname);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData('email');
    }

    /**
     * @param string $email
     * @return CustomerInterface
     */
    public function setEmail(string $email): CustomerInterface
    {
        return $this->setData('email', $email);
    }
}
