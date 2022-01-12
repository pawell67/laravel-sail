<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Models\Transaction;

class TransactionDBRepository implements TransactionRepository
{
    public function getTransactions(): array
    {
        return Transaction::all()->toArray();
    }
}
