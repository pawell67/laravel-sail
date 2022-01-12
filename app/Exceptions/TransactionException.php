<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class TransactionException extends Exception
{
    public static function invalidSource(string $source): self
    {
        return new self(sprintf('Invalid source provided: %s', $source));
    }

    public static function csvFileDoesNotExists(string $path): self
    {
        return new self(sprintf('CSV file at path: %s does not exist', $path));
    }
}
