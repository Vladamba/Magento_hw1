<?php

namespace Magedia\ManageProducts\Model;

use Magedia\ManageProducts\Api\Data\ProductInterface;
use Magedia\ManageProducts\Api\Data\ProductInterfaceFactory;
use Magedia\ManageProducts\Api\ProductRepositoryInterface as MyProductRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
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
     * @var ProductInterfaceFactory
     */
    private $productInterfaceFactory;

    /**
     * @var SearchCriteriaInterfaceFactory
     */
    private $searchCriteriaInterfaceFactory;

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
