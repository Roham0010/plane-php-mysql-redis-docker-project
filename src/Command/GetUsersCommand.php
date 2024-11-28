<?php

namespace App\Command;

use App\Service\UserService;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Retrives all users
 *
 * @package App\Command
 */
class GetUsersCommand extends Command
{
	private UserService $userService;

	public function __construct(UserService $userService)
	{
		parent::__construct('app:get-users');
		$this->userService = $userService;
	}

	protected function configure()
	{
		$this->setDescription('Get users');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		print_r($this->userService->getAllUsers());
		return Command::SUCCESS;
	}
}
