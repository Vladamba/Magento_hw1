<?php

namespace Magedia\ManageProducts\Model\Data;

use Magedia\ManageProducts\Api\Data\ProductInterface;
use Magento\Framework\DataObject;

class Product extends DataObject implements ProductInterface
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
     * @return $this
     */
    public function setId(int $id): ProductInterface
    {
        return $this->setData('id', $id);
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->getData('sku');
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku): ProductInterface
    {
        return $this->setData('sku', $sku);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData('name');
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): ProductInterface
    {
        return $this->setData('name', $name);
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->getData('qty');
    }

    /**
     * @param int $qty
     * @return $this
     */
    public function setQty(int $qty): ProductInterface
    {
        return $this->setData('qty', $qty);
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->getData('price');
    }

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice(string $price): ProductInterface
    {
        return $this->setData('price', $price);
    }
}
