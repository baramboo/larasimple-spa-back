<?php

namespace App\Repositories;

use App\Core\Repositories\BaseRepository;
use App\Core\Repositories\ResourceRepositoryInterface;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class PostRepository
 *
 * @package App\Repositories
 */
class PostRepository extends BaseRepository implements ResourceRepositoryInterface
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Post::class;
    }


    /**
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        $condition = $this->conditions()->with(['author', 'recentComments']);

        return QueryBuilder::for($condition)
            ->allowedFilters([ /** filtering process */
                AllowedFilter::exact(Post::getFieldAlias('id'), 'id'),
                AllowedFilter::exact(Post::getFieldAlias('author_id'), 'author_id'),
                AllowedFilter::scope(Post::getFieldAlias('commentAuthorId'), 'byCommentAuthorId'),
                AllowedFilter::partial(Post::getFieldAlias('title'), 'title'),
                AllowedFilter::partial(Post::getFieldAlias('description'), 'description'),
            ])
            ->allowedSorts([ /** sorting process */
                AllowedSort::field(Post::getFieldAlias('id'), 'id'),
                AllowedSort::field(Post::getFieldAlias('author_id'), 'author_id'),
            ])
            ->defaultSort('id')
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
     * @return Post
     */
    public function create(array $attributes): Post
    {
        return $this->conditions()::create($attributes);
    }

    /**
     * @param Post $model
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
