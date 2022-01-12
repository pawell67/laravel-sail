<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    public static function canNotBeDeleted(int $id): self
    {
        return new self(sprintf('User with id: %d can\'t be deleted', $id));
    }

    public static function notExists(int $id): self
    {
        return new self(sprintf('User with id: %d does not exist', $id));
    }

    public static function detailsNotExists(int $id): self
    {
        return new self(sprintf('User with id: %d does not have details', $id));
    }
}
