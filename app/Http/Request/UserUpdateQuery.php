<?php

declare(strict_types=1);

namespace App\Http\Request;

use GuzzleHttp\Psr7\ServerRequest;
use PhpParser\JsonDecoder;

class UserUpdateQuery
{
    private array $requestBody;

    public function __construct(protected ServerRequest $request, private int $id)
    {
        $this->requestBody = (new JsonDecoder())->decode($this->request->getBody()->getContents());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->requestBody['first_name'] ?? null;
    }

    public function getLastName(): ?string
    {
        return $this->requestBody['last_name'] ?? null;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->requestBody['phone_number'] ?? null;
    }

    public function getCountry(): ?string
    {
        return $this->requestBody['country'] ?? null;
    }
}
