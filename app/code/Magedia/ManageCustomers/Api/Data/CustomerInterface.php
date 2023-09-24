<?php

namespace Magedia\ManageCustomers\Api\Data;

interface CustomerInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): CustomerInterface;

    /**
     * @return string
     */
    public function getFirstname(): string;

    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname(string $firstname): CustomerInterface;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): CustomerInterface;
}
