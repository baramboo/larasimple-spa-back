<?php

namespace App\Core\Traits;

use Illuminate\Support\Carbon;

/**
 * Trait DateTrait
 * @package App\Core\Traits
 *
 * @property string $defaultDateFormat
 */
trait DateTrait
{
    protected $defaultDateFormat = 'Y-m-d H:i:s';

    /**
     * Convert created_at date
     * @return string
     */
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format($this->defaultDateFormat);
    }

    /**
     * Convert updated_at date
     * @return string
     */
    public function getUpdatedAtAttribute()
    {
        $updatedAt = $this->attributes['updated_at'];
        return ($updatedAt) ? Carbon::parse($this->attributes['updated_at'])->format($this->defaultDateFormat) : null;
    }
}
