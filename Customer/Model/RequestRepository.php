<?php
namespace Smile\Customer\Model;

use Smile\Customer\Api\Data;
use Smile\Customer\Api\RequestRepositoryInterface;
use Smile\Customer\Model\ResourceModel\Request as ResourceRequest;
use Smile\Customer\Model\ResourceModel\Request\CollectionFactory as RequestCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class RequestRepository
 * @package Smile\Customer\Model
 */
class RequestRepository implements RequestRepositoryInterface
{
    /**
     * @var ResourceRequest
     */
    private $resource;

    /**
     * @var RequestFactory
     */
    private $requestFactory;

    /**
     * @var RequestCollectionFactory
     */
    private $requestCollectionFactory;

    /**
     * @var Data\RequestSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * RequestRepository constructor.
     * @param ResourceRequest $resource
     * @param RequestFactory $requestFactory
     * @param RequestCollectionFactory $requestCollectionFactory
     * @param Data\RequestSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceRequest $resource,
        RequestFactory $requestFactory,
        RequestCollectionFactory $requestCollectionFactory,
        Data\RequestSearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->resource = $resource;
        $this->requestFactory = $requestFactory;
        $this->requestCollectionFactory = $requestCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Get request by requestId
     *
     * @param int $requestId
     *
     * @return RequestRepositoryInterface|Request
     *
     * @throws NoSuchEntityException
     */
    public function getById($requestId)
    {
        $request = $this->requestFactory->create();
        $this->resource->load($request, $requestId);
        if (!$request->getId()) {
            throw new NoSuchEntityException(__('Request with id "%1" does not exist.', $request));
        }
        return $request;
    }

    /**
     * Get requests by criteria
     *
     * @param SearchCriteriaInterface|null $criteria
     *
     * @return Data\RequestSearchResultsInterface|RequestRepositoryInterface
     */
    public function getList(SearchCriteriaInterface $criteria = null)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $collection = $this->requestCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $request = [];
        /** @var Data\RequestInterface $requestModel */
        foreach ($collection as $requestModel) {
            $request[] = $requestModel;
        }
        $searchResults->setItems($request);
        return $searchResults;
    }

    /**
     * Delete Request
     *
     * @param Data\RequestInterface $request
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     */
    public function delete(Data\RequestInterface $request)
    {
        try {
            $this->resource->delete($request);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Save request
     *
     * @param Data\RequestInterface $request
     *
     * @return Data\RequestInterface|RequestRepositoryInterface
     *
     * @throws CouldNotSaveException
     */
    public function save(Data\RequestInterface $request)
    {
        try {
            $this->resource->save($request);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $request;
    }

    /**
     * Delete request by id
     *
     * @param int $requestId
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($requestId)
    {
        return $this->delete($this->getById($requestId));
    }
}
