<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Exceptions\TransactionException;
use App\Models\Transaction;
use Throwable;

class TransactionFileRepository implements TransactionRepository
{
    /**
     * @throws TransactionException
     */
    public function getTransactions(): array
    {
        $filePath = storage_path('transactions.csv');
        try {
            $file = fopen($filePath, 'rb');
        } catch (Throwable $e) {
            throw TransactionException::csvFileDoesNotExists($filePath);
        }

        $key = fgetcsv($file, 1024);

        $transactions = collect();
        while ($row = fgetcsv($file, 1024)) {
            $transactions->push(new Transaction(array_combine($key, $row)));
        }

        fclose($file);

        return $transactions->toArray();
    }
}
