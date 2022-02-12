<?php

namespace App\Models\QueryBuilders;

use App\Core\Models\QueryBuilders\CoreEloquentBuilder;

/**
 * Class PostCommentQueryBuilder
 * @package App\Models\QueryBuilders
 */
class PostCommentQueryBuilder extends CoreEloquentBuilder
{

    /**
     * @param null $id
     * @return PostCommentQueryBuilder
     */
    public function byAuthorId($id): PostCommentQueryBuilder
    {
        return $this->where('author_id', $id);
    }

}
