<?php

namespace Magedia\ManageCustomers\Model;

use Magedia\ManageCustomers\Api\Data\CustomerInterface;
use Magedia\ManageCustomers\Api\Data\CustomerInterfaceFactory;
use Magedia\ManageCustomers\Api\CustomerRepositoryInterface as MyCustomerRepositoryInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaInterfaceFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

class CustomerRepository implements MyCustomerRepositoryInterface
{
    /**
     * @var MyCustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var CustomerInterfaceFactory
     */
    private $customerInterfaceFactory;

    /**
     * @var SearchCriteriaInterfaceFactory
     */
    private $searchCriteriaInterfaceFactory;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     * @param CustomerInterfaceFactory $customerInterfaceFactory
     * @param SearchCriteriaInterfaceFactory $searchCriteriaInterfaceFactory
     */
    public function __construct(
        CustomerRepositoryInterface    $customerRepository,
        CustomerInterfaceFactory       $customerInterfaceFactory,
        SearchCriteriaInterfaceFactory $searchCriteriaInterfaceFactory)
    {
        $this->customerRepository = $customerRepository;
        $this->customerInterfaceFactory = $customerInterfaceFactory;
        $this->searchCriteriaInterfaceFactory = $searchCriteriaInterfaceFactory;
    }

    /**
     * @param int $count
     * @return CustomerInterface[]
     */
    public function getCustomers(int $count)
    {
        /**
         * @var SearchCriteriaInterface $searchCriteria
         */
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
