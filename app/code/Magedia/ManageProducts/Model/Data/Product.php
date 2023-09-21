<?php

namespace Magedia\ManageProducts\Model\Data;

use Magedia\ManageProducts\Api\Data\ProductInterface;
use Magento\Framework\DataObject;

class Product extends DataObject implements ProductInterface
{
    /**
     * @return int
     */
    public function getId()
    {
        return $this->getData('id');
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData('id', $id);
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->getData('sku');
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData('sku', $sku);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData('name', $name);
    }

    /**
     * @return int
     */
    public function getQty()
    {
        return $this->getData('qty');
    }

    /**
     * @param int $qty
     * @return $this
     */
    public function setQty($qty)
    {
        return $this->setData('qty', $qty);
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->getData('price');
    }

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice($price)
    {
        return $this->setData('price', $price);
    }
}
