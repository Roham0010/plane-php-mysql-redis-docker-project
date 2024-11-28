<?php

namespace App\Command;

use App\Service\UserService;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Inserts random user data into the database.
 */
class PopulateUsersCommand extends Command
{
	private UserService $userService;

	public function __construct(UserService $userService)
	{
		parent::__construct('app:populate-users');
		$this->userService = $userService;
	}

	protected static $defaultName = 'app:populate-users';

	protected function configure()
	{
		$this->setDescription('Populates the database with random user data.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$faker = Factory::create();

		for ($i = 0; $i < 10; $i++) {
			$name = $faker->name;
			$credit = $faker->randomFloat(2, 0, 1000);

			$this->userService->createUser($name, $credit);
		}

		$output->writeln('Users have been populated.');
		return Command::SUCCESS;
	}
}
