<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\UserService;
use App\Exceptions\UserException;
use App\Http\Request\UserSelectQuery;
use App\Http\Request\UserUpdateQuery;
use App\Http\Response\UserPresenter;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    public function getUsers(): Response
    {
        $query = new UserSelectQuery($this->request);
        $users = $this->userService->getUsers($query);

        return new Response((new UserPresenter($users))->present());
    }

    public function updateUserDetails(int $id): Response
    {
        $query = new UserUpdateQuery($this->request, $id);
        try {
            $user = $this->userService->updateUserDetails($query);
        } catch (UserException $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return new Response((new UserPresenter($user))->present());
    }

    public function delete(int $id): Response
    {
        try {
            $this->userService->deleteUser($id);

            return (new Response())
                ->setContent(sprintf('User with id: %d deleted', $id))
                ->setStatusCode(Response::HTTP_OK);
        } catch (UserException $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
