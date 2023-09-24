<?php

declare(strict_types=1);

namespace Magedia\CustomerManagement\Model;

use Magedia\CustomerManagement\Api\Data\CustomerInterface;
use Magedia\CustomerManagement\Api\CustomerRepositoryInterface as MyCustomerRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterfaceFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomerRepository implements MyCustomerRepositoryInterface
{
    /**
     * @var MyCustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var SearchCriteriaInterfaceFactory
     */
    private $searchCriteriaInterfaceFactory;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     * @param SearchCriteriaInterfaceFactory $searchCriteriaInterfaceFactory
     */
    public function __construct(
        CustomerRepositoryInterface    $customerRepository,
        SearchCriteriaInterfaceFactory $searchCriteriaInterfaceFactory)
    {
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaInterfaceFactory = $searchCriteriaInterfaceFactory;
    }

    /**
     * @param int $count
     * @return CustomerInterface[]
     * @throws LocalizedException
     */
    public function getCustomers(int $count)
    {
        $searchCriteria = $this->searchCriteriaInterfaceFactory->create();
        $searchCriteria->setPageSize($count);

        /**
         * @var CustomerInterface[] $customers
         */
        $customers = $this->customerRepository->getList($searchCriteria)->getItems();

        return $customers;
    }

    /**
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteCustomerById(int $id): bool
    {
        return $this->customerRepository->deleteById($id);
    }
}
