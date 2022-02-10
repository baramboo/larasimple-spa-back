<?php

namespace App\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class BaseRepository
 * @package App\Core\Repositories
 *
 * @property Model $model
 */
abstract class BaseRepository
{

    /** @var Model */
    protected $model;

    protected $defaultPaginatorName = 'limit';
    protected $defaultPaginatorPerPage = 3;
    protected $defaultPaginatorRelatedResents = 3;

    public function __construct()
    {
        $this->model = app($this->getModelClass());

        $this->defaultPaginatorName = config('paginator.default_paginate_name');
        $this->defaultPaginatorPerPage = config('paginator.default_paginate_per_page');
        $this->defaultPaginatorRelatedResents = config('paginator.default_related_resents');

    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * Conditions for queryBuilder to get Model or Collection of Models
     *
     * @return Model
     */
    protected function conditions(): Model
    {
        return clone $this->model;
    }

    /**
     * @param $id
     * @return Collection
     */
    public function whereId($id): Collection
    {
        return $this->conditions()->findOrFail($id);
    }
}
