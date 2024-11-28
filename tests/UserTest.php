<?php

namespace Tests;

use App\Database\Database;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Service\UserService;

class UserTest extends BaseTest
{
	/**
	 * Tests the creation of a user
	 *
	 * @return void
	 */
	public function testUserCreatoin()
	{
		$this->setUp();

		$name = 'JohnN';
		$credit = 100.1;

		$repo = new UserRepository(new Database());
		$userService = new UserService($repo);

		$dbUser = $userService->createUser($name, $credit);

		$this->assertEquals($name, $dbUser->getName());
		$this->assertEquals($credit, $dbUser->getCredit());
	}

	public function testUserProperties()
	{
		$this->markTestIncomplete('Should be impmemented.');
	}
}
