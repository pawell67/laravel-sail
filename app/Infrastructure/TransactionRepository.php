<?php

declare(strict_types=1);

namespace App\Infrastructure;

interface TransactionRepository
{
    public function getTransactions(): array;
}
