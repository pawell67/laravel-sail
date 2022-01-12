<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserDetails extends Model
{
    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'citizenship_country_id',
        'first_name',
        'last_name',
        'phone_number'
    ];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): HasOne
    {
        return $this->hasOne(
            Country::class,
            'id',
            'citizenship_country_id'
        );
    }
}
