<?php

namespace Sandesh\ReportIssue\Model;

use Exception;
use Magento\Framework\Exception\AlreadyExistsException;
use Sandesh\ReportIssue\Api\Data\ReportIssueInterface as Model;
use Sandesh\ReportIssue\Api\Data\ReportIssueInterfaceFactory as ModelFactory;
use Sandesh\ReportIssue\Api\ReportIssueRepositoryInterface;
use Sandesh\ReportIssue\Model\ResourceModel\ReportIssue as ResourceModel;
use Sandesh\ReportIssue\Model\ResourceModel\ReportIssue\CollectionFactory;

class ReportIssueRepository implements ReportIssueRepositoryInterface
{
    /**
     * @var ModelFactory
     */
    private $modelFactory;
    /**
     * @var ResourceModel
     */
    private $resourceModel;
    /**
     * @var CollectionFactory
     */
    private $collection;

    /**
     * ReportIssueRepository constructor.
     * @param ModelFactory $modelFactory
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collection
     */
    public function __construct(
        ModelFactory $modelFactory,
        ResourceModel $resourceModel,
        CollectionFactory $collection
    ) {
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        $this->collection = $collection;
    }

    /**
     * @inheritDoc
     */
    public function create(): Model
    {
        return $this->modelFactory->create();
    }

    /**
     * @inheritDoc
     */
    public function load($value, $field = null): Model
    {
        $model = $this->create();
        $this->resourceModel->load($model, $value, $field);
        if (!$model->getEntityId()) {
            $model = $this->create();
        }
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id): Model
    {
        return $this->load($id);
    }

    /**
     * @inheritDoc
     */
    public function save(Model $model): Model
    {
        try {
            $this->resourceModel->save($model);
        } catch (AlreadyExistsException | Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $model;
    }

    /**
     * @inheritDoc
     */
    public function delete(Model $model): bool
    {
        try {
            $this->resourceModel->delete($model);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): bool
    {
        $model = $this->load($id);
        try {
            return $this->delete($model);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    public function getCollection()
    {
        return $this->collectionFactory->create();
    }
}
