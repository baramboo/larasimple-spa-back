<?php

namespace App\Core\Models\Traits;

use App\Core\Models\QueryBuilders\CoreQueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
     * Default paginator
     *
     * Call ->withPaginate() function in your model query builders to get default paginator.
     * If you want to use your own custom pagination - call ->paginate(//with params
     *
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function withPaginate(int $limit = 10) : LengthAwarePaginator
    {
        return $this->paginate(request()->query('limit', $limit));
    }
}
