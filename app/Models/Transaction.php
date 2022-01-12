<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'code',
        'amount',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
