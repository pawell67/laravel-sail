<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'iso2',
        'iso3',
    ];
    public $timestamps = false;

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_details',
            'citizenship_country_id',
            'user_id'
        );
    }
}
