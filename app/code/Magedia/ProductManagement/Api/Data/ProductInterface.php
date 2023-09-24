<?php

namespace Magedia\ProductManagement\Api\Data;

interface ProductInterface
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): ProductInterface;

    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku): ProductInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): ProductInterface;

    /**
     * @return int
     */
    public function getQty(): int;

    /**
     * @param int $qty
     * @return $this
     */
    public function setQty(int $qty): ProductInterface;

    /**
     * @return string
     */
    public function getPrice(): string;

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice(string $price): ProductInterface;
}
