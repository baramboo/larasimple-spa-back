<?php

namespace App\Core\Models\Traits;

use App\Core\Models\QueryBuilders\CoreEloquentBuilder;
use App\Core\Models\QueryBuilders\CoreQueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

trait QueryBuilderTrait
{
    /**
     * Bind base query builder
     *
     * @return CoreQueryBuilder | Builder
     */
    protected function newBaseQueryBuilder()
    {
        $connection = $this->getConnection();

        return new CoreQueryBuilder(
            $connection, $connection->getQueryGrammar(), $connection->getPostProcessor()
        );
    }

    /**
     * Bind base eloquent builder
     *
     * @param Builder $query
     * @return CoreEloquentBuilder|\Illuminate\Database\Eloquent\Builder|Model
     */
    public function newEloquentBuilder($query)
    {
        return new CoreEloquentBuilder($query);
    }
}
