<?php

namespace App\Command;

use App\Service\TransactionService;
use App\Service\UserService;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * It's a sample of getting multiple objects with diferent filders by specifying types.
 */
class GetCommand extends Command
{
	private UserService $userService;
	private TransactionService $transactionService;

	public function __construct(TransactionService $transactionService, UserService $userService)
	{
		parent::__construct('app:get');
		$this->transactionService = $transactionService;
		$this->userService = $userService;
	}

	protected function configure()
	{
		$this->setDescription('Get objects by type.')
			->addOption('type', null, InputOption::VALUE_REQUIRED, '');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$type = $input->getOption('type');

		switch ($type) {
			case 'transactions':
				print_r($this->transactionService->getAllTransactions());
			default:
				echo "Unknown type: $type\n";
		}

		return Command::SUCCESS;
	}
}
