<?php

namespace Magedia\ManageProducts\Api\Data;

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
    public function setId($id): ProductInterface;

    /**
     * @return string
     */
    public function getSku(): string;

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku): ProductInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name): ProductInterface;

    /**
     * @return int
     */
    public function getQty(): int;

    /**
     * @param int $qty
     * @return $this
     */
    public function setQty($qty): ProductInterface;

    /**
     * @return string
     */
    public function getPrice(): string;

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice($price): ProductInterface;
}
