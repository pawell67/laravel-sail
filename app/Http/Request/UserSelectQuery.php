<?php

declare(strict_types=1);

namespace App\Http\Request;

use GuzzleHttp\Psr7\ServerRequest;

class UserSelectQuery
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public function __construct(protected ServerRequest $request)
    {
    }

    public function getStatus(): string
    {
        return $this->request->getQueryParams()['status'] ?? self::STATUS_ACTIVE;
    }

    public function getCountry(): ?string
    {
        return $this->request->getQueryParams()['country'] ?? null;
    }
}
