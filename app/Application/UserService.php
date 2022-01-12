<?php

declare(strict_types=1);

namespace App\Application;

use App\Exceptions\UserException;
use App\Http\Request\UserSelectQuery;
use App\Http\Request\UserUpdateQuery;
use App\Infrastructure\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function getUsers(UserSelectQuery $query): Collection
    {
        return $this->userRepository->getUsers($query);
    }

    /**
     * @throws UserException
     */
    public function updateUserDetails(UserUpdateQuery $query): Collection
    {
        if (!$this->userRepository->userDetailsExists($query->getId())) {
            throw UserException::detailsNotExists($query->getId());
        }

        return $this->userRepository->updateUserDetails($query);
    }

    /**
     * @throws UserException
     */
    public function deleteUser(int $id): void
    {
        if (!$this->userRepository->userExists($id)) {
            throw UserException::notExists($id);
        }

        if (!$this->userRepository->userDetailsExists($id)) {
            $this->userRepository->deleteUser($id);

            return;
        }

        throw UserException::canNotBeDeleted($id);
    }
}
