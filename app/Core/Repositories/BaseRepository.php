<?php

namespace App\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

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

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model
     */
    protected function conditions()
    {
        return clone $this->model;
    }
}
