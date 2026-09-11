<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sector extends Model
{
    protected $fillable = [
        'sector_number',
        'name',
        'parent_sector_number'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'parent_sector_number', 'sector_number');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Sector::class, 'parent_sector_number', 'sector_number');
    }

    // Get the childrens children etc
    public function allChildren(): HasMany
    {
        return $this->children()->with('allChildren');
    }
}
