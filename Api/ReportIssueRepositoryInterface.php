<?php

namespace Sandesh\ReportIssue\Api;

use Sandesh\ReportIssue\Api\Data\ReportIssueInterface as Model;
use Sandesh\ReportIssue\Model\ResourceModel\ReportIssue\Collection;

interface ReportIssueRepositoryInterface
{
    /**
     * @return Model
     */
    public function create(): Model;

    /**
     * @param $value
     * @param null $field
     * @return Model
     */
    public function load($value, $field = null): Model;

    /**
     * @param int $id
     * @return Model
     */
    public function getById(int $id): Model;

    /**
     * @param Model $model
     * @return Model
     */
    public function save(Model $model): Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;

    /**
     * @return Collection
     */
    public function getCollection();
}
