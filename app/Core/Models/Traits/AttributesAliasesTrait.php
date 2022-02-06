<?php

namespace App\Core\Models\Traits;

use Illuminate\Support\Arr;
use InvalidArgumentException;

trait AttributesAliasesTrait
{
    /**
     * Get eloquent attribute alias
     *
     * @param null $attribute
     * @param null $defaultValue
     * @return mixed
     */
    public static function getFieldAlias($attribute = null, $defaultValue = null)
    {
        if (!$attribute) {
            throw new InvalidArgumentException('$attribute name is required!');
        }
        return Arr::get(
            static::attributesAliases(),
            $attribute,
            (!$defaultValue) ? $attribute : $defaultValue
        );
    }

    /**
     * Get true db field name
     * @param null $alias
     * @param null $defaultValue
     * @return mixed
     */
    public static function getRealFieldName($alias = null, $defaultValue = null)
    {
        if (!$alias) {
            throw new InvalidArgumentException('$alias is required!');
        }
        return Arr::get(
            array_flip(static::attributesAliases()),
            $alias,
            (!$defaultValue) ? $alias : $defaultValue
        );
    }

    /**
     * Get all bd field aliases
     * @return array
     */
    public static function getAllFieldAliases()
    {
        return array_values(static::attributesAliases());
    }

    /**
     * Get all db real names
     * @return array
     */
    public static function getAllRealFields()
    {
        return array_keys(static::attributesAliases());
    }
}
