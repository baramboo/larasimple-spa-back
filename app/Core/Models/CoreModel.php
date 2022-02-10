<?php

namespace App\Core\Models;

use App\Core\Models\Interfaces\AttributesAliasesInterface;
use App\Core\Models\QueryBuilders\CoreQueryBuilder;
use App\Core\Models\Traits\AttributesAliasesTrait;
use App\Core\Models\Traits\QueryBuilderTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Core Model class
 *
 * @method CoreQueryBuilder withPaginate($defaultLimit)
 * @package App\Core\Models\CoreModel
 */
abstract class CoreModel extends Model implements AttributesAliasesInterface
{
    use AttributesAliasesTrait, QueryBuilderTrait;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

}
