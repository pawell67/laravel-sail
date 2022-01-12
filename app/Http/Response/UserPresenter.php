<?php

declare(strict_types=1);

namespace App\Http\Response;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserPresenter
{
    public function __construct(private Collection $collection)
    {
    }

    public function present(): array
    {
        $users = [];
        /** @var User $user */
        foreach ($this->collection as $user) {
            $users[] = [
                'id' => $user->getAttribute('id'),
                'email' => $user->getAttribute('email'),
                'name' => $user->getRelation('userDetails')?->getAttribute('first_name'),
                'last_name' => $user->getRelation('userDetails')?->getAttribute('last_name'),
                'phone' => $user->getRelation('userDetails')?->getAttribute('phone_number'),
                'country' => $user->getRelation('userDetails')?->getRelation('country')?->getAttribute('name'),
            ];
        }
        return $users;
    }
}
