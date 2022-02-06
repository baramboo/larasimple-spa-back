<?php

namespace App\Repositories;

use App\Core\Repositories\BaseRepository;
use App\Core\Repositories\ResourceRepositoryInterface;
use App\Models\PostComment;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PostCommentRepository
 *
 * @package App\Repositories
 */
class PostCommentRepository extends BaseRepository implements ResourceRepositoryInterface
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return PostComment::class;
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
     * @return PostComment
     */
    public function create(array $attributes): PostComment
    {
        return $this->conditions()::create($attributes);
    }

    /**
     * @param PostComment $model
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
