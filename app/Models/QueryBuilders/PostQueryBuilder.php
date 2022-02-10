<?php

namespace App\Models\QueryBuilders;

use App\Core\Models\QueryBuilders\CoreEloquentBuilder;

/**
 * Class PostQueryBuilder
 * @package App\Models\QueryBuilders
 */
class PostQueryBuilder extends CoreEloquentBuilder
{
    /**
     * @param null $id
     * @return PostQueryBuilder
     */
    public function byCommentAuthorId($id) : PostQueryBuilder
    {
        return $this->whereHas('comments', function ($query) use ($id) {
            return $query->where('author_id', $id);
        });
    }
}
