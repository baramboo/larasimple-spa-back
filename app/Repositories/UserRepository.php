<?php

namespace App\Repositories;

use App\Core\Repositories\BaseRepository;
use App\Core\Repositories\ResourceRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends BaseRepository implements ResourceRepositoryInterface
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return User::class;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->conditions()->get();
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getById($id)
    {
        return $this->conditions()->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): User
    {
        return $this->conditions()::create($attributes);
    }

    /**
     * @param User $model
     * @param array $attributes
     * @return bool
     */
    public function update($model, array $attributes)
    {
        return $model->update($attributes);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model)
    {
        return $model->delete();
    }
}
