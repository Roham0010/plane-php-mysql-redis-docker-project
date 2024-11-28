<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;

class UserService
{
	private UserRepositoryInterface $userRepository;

	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function createUser(string $name, float $credit): User
	{
		$user = new User($name, $credit);
		$this->userRepository->create($user);
		return $user;
	}

	public function getAllUsers(): array
	{
		return $this->userRepository->findAll();
	}
}
