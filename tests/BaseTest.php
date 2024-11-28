<?php

namespace Tests;

use App\Database\Database;
use App\Database\Migrations;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Dotenv\Dotenv;

class BaseTest extends TestCase
{
	public function setUp(): void
	{
		if (file_exists(__DIR__ . '/../.env.test')) {
			$dotenv = new Dotenv();
			$dotenv->usePutenv();
			$dotenv->load(__DIR__ . '/../.env.test');
		} else {
			throw \Exception('.env.test not found');
		}

		putenv('APP_ENV=test');

		// TODO:Drop all data!
		Migrations::migrate(new Database());
	}

	public function tearDown(): void
	{
		$dotenv = new Dotenv();
		$dotenv->usePutenv();
		$dotenv->load(__DIR__ . '/../.env');

		putenv('APP_ENV=local');
	}

	public function testSample()
	{
		$this->assertTrue(true);
	}
}
