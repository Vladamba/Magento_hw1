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
    public function setId($id): ProductInterface
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
    public function setSku($sku): ProductInterface
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
    public function setName($name): ProductInterface
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
    public function setQty($qty): ProductInterface
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
    public function setPrice($price): ProductInterface
    {
        return $this->setData('price', $price);
    }
}
