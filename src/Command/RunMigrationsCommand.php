<?php

namespace App\Command;

use App\Database\Database;
use App\Database\Migrations;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to run database migrations
 */
class RunMigrationsCommand extends Command
{
	public function __construct()
	{
		parent::__construct('app:migrate');
	}

	protected function configure()
	{
		$this->setDescription('Runs database migrations.');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		// Here you would run your database migrations
		// For simplicity, this is a placeholder
		Migrations::migrate(new Database());

		return Command::SUCCESS;
	}
}
