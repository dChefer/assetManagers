<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    const STATE_MAINTENANCE         = 'maintenance';
    const STATE_MAINTENANCE_PENDING = 'maintenance_pending';
    const STATE_ACTIVE              = 'active';
    const STATE_INACTIVE            = 'inactive';
    const STATES = [
        self::STATE_MAINTENANCE,
        self::STATE_MAINTENANCE_PENDING,
        self::STATE_ACTIVE,
        self::STATE_INACTIVE,
    ];

    protected $fillable = [
        'place_id',
        'manufacturer_id',
        'category_id',
        'model',
        'description',
        'state',
        'patrimony',
        'acquisition_value'
    ];

    /**
     * @return HasMany
     */
    public function occurrences()
    {
        return $this->hasMany(Occurrence::class);
    }
}
