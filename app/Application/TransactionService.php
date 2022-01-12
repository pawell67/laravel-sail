<?php

declare(strict_types=1);

namespace App\Application;

use App\Exceptions\TransactionException;
use App\Infrastructure\TransactionDBRepository;
use App\Infrastructure\TransactionFileRepository;

class TransactionService
{
    /**
     * @throws TransactionException
     */
    public function getTransactions(string $source): array
    {
        $repository = match ($source) {
            'db' => new TransactionDBRepository(),
            'csv' => new TransactionFileRepository(),
            default => throw TransactionException::invalidSource($source),
        };

        return $repository->getTransactions();
    }
}
