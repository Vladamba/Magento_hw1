<?php

namespace Magedia\ProductManagement\Api;

interface ProductRepositoryInterface
{
    /**
     * @param int $count
     * @return \Magedia\ProductManagement\Api\Data\ProductInterface[]
     */
    public function getProducts(int $count);


    /**
     * @param string $sku
     * @return bool
     */
    public function deleteProductBySku(string $sku): bool;
}
