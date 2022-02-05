<?php

namespace App\Core\Repositories;

/**
 * Interface ResourceRepositoryInterface
 *
 * @package App\Core\Repositories
 */
interface ResourceRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function create(array $attributes);

    public function update($model, array $attributes);

    public function delete($model);
}
