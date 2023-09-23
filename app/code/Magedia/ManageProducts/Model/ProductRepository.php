<?php

namespace Magedia\ManageProducts\Model;

use Magedia\ManageProducts\Api\Data\ProductInterface;
use Magedia\ManageProducts\Api\Data\ProductInterfaceFactory;
use Magedia\ManageProducts\Api\ProductRepositoryInterface as MyProductRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaInterfaceFactory;

class ProductRepository implements MyProductRepositoryInterface
{
    /**
     * @var SearchCriteriaInterfaceFactory
     */
    private $searchCriteriaInterfaceFactory;

    /**
     * @var ProductInterfaceFactory
     */
    private $productInterfaceFactory;

    /**
     * @var MyProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param ProductInterfaceFactory $productInterfaceFactory
     * @param SearchCriteriaInterfaceFactory $searchCriteriaInterfaceFactory
     */
    public function __construct(
        ProductRepositoryInterface     $productRepository,
        ProductInterfaceFactory        $productInterfaceFactory,
        SearchCriteriaInterfaceFactory $searchCriteriaInterfaceFactory)
    {
        $this->productRepository = $productRepository;
        $this->productInterfaceFactory = $productInterfaceFactory;
        $this->searchCriteriaInterfaceFactory = $searchCriteriaInterfaceFactory;
    }

    /**
     * @param int $count
     * @return ProductInterface[]
     */
    public function getProducts(int $count)
    {
        /**
         * @var SearchCriteriaInterface $searchCriteria
         */
        $searchCriteria = $this->searchCriteriaInterfaceFactory->create();
        $searchCriteria->setPageSize($count);

        /**
         * @var ProductInterface[] $products
         */
        $products = $this->productRepository->getList($searchCriteria)->getItems();

        /**
         * @var ProductInterface[] $productInterfaceArray
         */
        $productInterfaceArray = [];

        foreach ($products as $product) {
            $productInterface = $this->productInterfaceFactory->create();
            $productInterface->setId($product->getId());
            $productInterface->setSku($product->getSku());
            $productInterface->setName($product->getName());
            $productInterface->setQty($product->getQty());
            $productInterface->setPrice($product->getPrice());
            $productInterfaceArray[] = $productInterface;
        }
        return $productInterfaceArray;
    }

    /**
     * @param string $sku
     * @return bool
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
