<?php

declare(strict_types=1);

namespace Magedia\ProductManagement\Model;

use Magedia\ProductManagement\Api\Data\ProductInterface;
use Magedia\ProductManagement\Api\ProductRepositoryInterface as MyProductRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

class ProductRepository implements MyProductRepositoryInterface
{
    /**
     * @var MyProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var SearchCriteriaInterfaceFactory
     */
    private $searchCriteriaInterfaceFactory;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaInterfaceFactory $searchCriteriaInterfaceFactory
     */
    public function __construct(
        ProductRepositoryInterface     $productRepository,
        SearchCriteriaInterfaceFactory $searchCriteriaInterfaceFactory)
    {
        $this->productRepository = $productRepository;
        $this->searchCriteriaInterfaceFactory = $searchCriteriaInterfaceFactory;
    }

    /**
     * @param int $count
     * @return ProductInterface[]
     */
    public function getProducts(int $count)
    {
        $searchCriteria = $this->searchCriteriaInterfaceFactory->create();
        $searchCriteria->setPageSize($count);

        /**
         * @var ProductInterface[] $products
         */
        $products = $this->productRepository->getList($searchCriteria)->getItems();

        return $products;
    }

    /**
     * @param string $sku
     * @return bool
     * @throws NoSuchEntityException
     * @throws StateException
     */
    public function deleteProductBySku(string $sku): bool
    {
        /**
         * @var ProductInterface $product
         */
        $product = $this->productRepository->get($sku);

        return $this->productRepository->delete($product);
    }
}
