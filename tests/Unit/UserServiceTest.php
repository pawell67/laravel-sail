<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Application\UserService;
use App\Exceptions\UserException;
use App\Infrastructure\UserRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    protected UserService|MockObject $systemUnderTests;
    protected UserRepository|MockObject $repository;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(UserRepository::class);
        $this->systemUnderTests = new UserService($this->repository);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionOnUserDetailsExists(): void
    {
        $userId = 1;

        $this->expectException(UserException::class);

        $this->repository->expects(self::once())
            ->method('userExists')
            ->willReturn(true);

        $this->repository->expects(self::once())
            ->method('userDetailsExists')
            ->willReturn(true);

        $this->repository->expects(self::never())
            ->method('deleteUser');

        $this->systemUnderTests->deleteUser($userId);
    }

    /**
     * @test
     */
    public function shouldDeleteUser(): void
    {
        $userId = 1;

        $this->repository->expects(self::once())
            ->method('userExists')
            ->willReturn(true);

        $this->repository->expects(self::once())
            ->method('userDetailsExists')
            ->willReturn(false);

        $this->repository->expects(self::once())
            ->method('deleteUser');

        $this->systemUnderTests->deleteUser($userId);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionOnUserNotExists(): void
    {
        $userId = 1;

        $this->expectException(UserException::class);

        $this->repository->expects(self::once())
            ->method('userExists')
            ->willReturn(false);

        $this->systemUnderTests->deleteUser($userId);
    }
}
