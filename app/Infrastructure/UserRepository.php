<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Http\Request\UserSelectQuery;
use App\Http\Request\UserUpdateQuery;
use App\Models\Country;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    public function getUsers(UserSelectQuery $query): Collection
    {
        $builder = User::query()
            ->with('userDetails.country')
            ->where('active', $query->getStatus() === UserSelectQuery::STATUS_INACTIVE ? 0 : 1);

        $country = $query->getCountry();
        if ($country !== null) {
            $builder->whereHas('userDetails.country', function (Builder $query) use ($country) {
                $this->whereCountryLike($query, $country);
            });
        }

        return $builder->get();
    }

    public function userExists(int $id): bool
    {
        return User::query()
            ->where('id', $id)
            ->exists();
    }

    public function userDetailsExists(int $id): bool
    {
        return UserDetails::query()
            ->where('user_id', $id)
            ->exists();
    }

    private function countryExists(string $name): bool
    {
        return $this
            ->whereCountryLike(Country::query(), $name)
            ->exists();
    }

    private function whereCountryLike(Builder $query, string $name): Builder
    {
        return $query->where('name', 'LIKE', '%' . $name . '%')
            ->orWhere('iso2', 'LIKE', '%' . strtoupper($name) . '%')
            ->orWhere('iso3', 'LIKE', '%' . strtoupper($name) . '%');
    }

    public function deleteUser(int $id): void
    {
        User::destroy($id);
    }

    public function updateUserDetails(UserUpdateQuery $query): Collection
    {
        $user = $this->getUserById($query->getId());

        $attributes = [];
        if ($query->getFirstName() !== null) {
            $attributes['first_name'] = $query->getFirstName();
        }
        if ($query->getLastName() !== null) {
            $attributes['last_name'] = $query->getLastName();
        }
        if ($query->getPhoneNumber() !== null) {
            $attributes['phone_number'] = $query->getPhoneNumber();
        }
        if ($query->getCountry() !== null && $this->countryExists($query->getCountry())) {
            $attributes['citizenship_country_id'] = $this->getCountryId($query->getCountry());
        }

        $user?->userDetails->update($attributes);

        return new Collection([$this->getUserById($query->getId())]);
    }

    private function getCountryId(string $country): int
    {
        return $this
            ->whereCountryLike(Country::query(), $country)
            ->first('id')->id;
    }

    private function getUserById(int $id): Model|null
    {
        return User::query()
            ->with('userDetails.country')
            ->where('id', $id)
            ->first();
    }
}
