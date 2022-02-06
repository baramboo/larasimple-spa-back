<?php

namespace App\Core\Models\QueryBuilders;

use Illuminate\Database\Eloquent\Builder as BaseBuilder;

/**
 * Class BaseEloquentBuilder
 * @package App\Models\QueryBuilders\BaseEloquentBuilder
 */
class CoreEloquentBuilder extends BaseBuilder
{
    //TODO IMPLEMENT BASE METHODS FOR ALL Eloquent QUERY BUILDERS CLASSES

    const LIMIT_PAGINATE_PARAM_NAME = 'limit';
    const DEFAULT_PAGINATE_LIMIT = 10;

    /**
     * Base eloquent paginate
     * @param int $defaultLimit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function withPaginate($defaultLimit = self::DEFAULT_PAGINATE_LIMIT)
    {
        return $this->paginate(request()->query(self::LIMIT_PAGINATE_PARAM_NAME, $defaultLimit));
    }
}
