<?php

namespace App\Repositories;

use App\Core\Repositories\BaseRepository;
use App\Core\Repositories\ResourceRepositoryInterface;
use App\Models\PostComment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

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
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        $condition = $this->conditions()->with(['author','post:id,title']);

        return QueryBuilder::for($condition)
            ->allowedFilters([ /** filtering process */
                AllowedFilter::exact(PostComment::getFieldAlias('id'), 'id'),
                AllowedFilter::exact(PostComment::getFieldAlias('author_id'), 'author_id'),
                AllowedFilter::partial(PostComment::getFieldAlias('comment'), 'comment'),
            ])
            ->allowedSorts([ /** sorting process */
                AllowedSort::field(PostComment::getFieldAlias('id'), 'id'),
                AllowedSort::field(PostComment::getFieldAlias('author_id'), 'author_id'),
            ])
            ->defaultSort('-id')
            ->paginate(request()->query($this->defaultPaginatorName, $this->defaultPaginatorPerPage));
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
