<?php

namespace Magedia\AccountManagement\Api\Data;

interface AccountInterface
{
    /**
     * @var string DB_NAME
     */
    const DB_NAME = 'account_management_customer_ip';

    /**
     * @var string ID
     */
    const ID = 'id';

    /**
     * @var string CUSTOMER_ID
     */
    const CUSTOMER_ID = 'customer_id';

    /**
     * @var string IP_ADDRESS
     */
    const IP_ADDRESS = 'ip_address';

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id);

    /**
     * @return int
     */
    public function getCustomerId(): int;

    /**
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId(int $customerId);

    /**
     * @return string
     */
    public function getIpAddress(): string;

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress(string $ipAddress);
}
