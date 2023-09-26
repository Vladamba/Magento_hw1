<?php

namespace Magedia\AccountManagement\Model;

use Magedia\AccountManagement\Api\Data\AccountInterface;
use Magedia\AccountManagement\Model\ResourceModel\Account as AccountResource;
use Magento\Framework\Model\AbstractModel;

class Account extends AbstractModel implements AccountInterface
{
    /**
     * @var string $_idFieldName
     */
    protected $_idFieldName = AccountInterface::ID;

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(AccountResource::class);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getData(AccountInterface::ID);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(mixed $id)
    {
        $this->setData(AccountInterface::ID, $id);
        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->getData(AccountInterface::CUSTOMER_ID);
    }

    /**
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId(int $customerId)
    {
        $this->setData(AccountInterface::CUSTOMER_ID, $customerId);
        return $this;
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->getData(AccountInterface::IP_ADDRESS);
    }

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress(string $ipAddress)
    {
        $this->setData(AccountInterface::IP_ADDRESS, $ipAddress);
        return $this;
    }
}
