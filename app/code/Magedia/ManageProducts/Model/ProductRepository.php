<?php

namespace Magedia\ManageProducts\Model;

use Magedia\ManageProducts\Api\Data\ProductInterface;
use Magedia\ManageProducts\Api\Data\ProductInterfaceFactory;
use Magedia\ManageProducts\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\Filter;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\ObjectFactory;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var ObjectFactory
     */
    private $objectFactory;

    /**
     * @var ProductInterfaceFactory
     */
    private $productInterfaceFactory;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductRepository constructor
     * @param ProductInterfaceFactory $productInterfaceFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     */
    public function __construct(
        ObjectFactory                                   $objectFactory,
        ProductInterfaceFactory                         $productInterfaceFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository)
    {
        $this->objectFactory = $objectFactory;
        $this->productInterfaceFactory = $productInterfaceFactory;
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $count
     * @return ProductInterface[]
     */
    public function getProducts(int $count)
    {
        /**
         * @var SortOrder $sortOrder
         */
        $sortOrder = $this->objectFactory->create(SortOrder::class, []);
        $sortOrder->setField("id")->setDirection("ASC");

        /**
         * @var SearchCriteriaInterface $searchCriteria
         */
        $searchCriteria = $this->objectFactory->create(SearchCriteriaInterface::class, []);
        $searchCriteria->setSortOrders([$sortOrder]);
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
            //echo $product->getId() . PHP_EOL;
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
    public function deleteProductBySku(string $sku)
    {
        /**
         * @var  Filter $filter
         */
        $filter = $this->objectFactory->create(Filter::class, []);
        $filter->setField("sku")->setValue($sku)->setConditionType("eq");

        /**
         * @var  FilterGroup $filterGroup
         */
        $filterGroup = $this->objectFactory->create(FilterGroup::class, []);
        $filterGroup->setFilters([$filter]);

        /**
         * @var SearchCriteriaInterface $searchCriteria
         */
        $searchCriteria = $this->objectFactory->create(SearchCriteriaInterface::class, []);
        $searchCriteria->setFilterGroups([$filterGroup]);

        /**
         * @var \Magento\Catalog\Api\Data\ProductSearchResultsInterface $list
         */
        $list = $this->productRepository->getList($searchCriteria);

        if ($list->getTotalCount() == 0) {
            return false;
        }
        /**
         * @var ProductInterface[] $products
         */
        $products = $list->getItems();
        foreach ($products as $product) {
            //echo $product->getSku() . PHP_EOL;
            $this->productRepository->delete($product);
        }
        return true;
    }
}
