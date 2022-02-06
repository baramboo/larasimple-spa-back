<?php

namespace App\Core\Models\Interfaces;

interface AttributesAliasesInterface
{

    /**
     * Set aliases for eloquent attributes (needle for filtering by Spatie Packagist)
     * @return array
     */
    public static function attributesAliases() : array ;
}
