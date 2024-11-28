<?php

namespace App\Command;

use App\Service\TransactionService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateReportCommand extends Command
{
	private TransactionService $transactionService;

	public function __construct(TransactionService $transactionService)
	{
		parent::__construct('app:generate-report');
		$this->transactionService = $transactionService;
	}

	protected function configure()
	{
		$this->setDescription('Generates a report of transactions.')
			->addOption('type', null, InputOption::VALUE_REQUIRED, '');
	}

	/**
	 * This command generates transaction reports based on the specified type option.
	 *
	 * There are two types of reports available:
	 * 1. per_user_per_day: Generates a report of transactions grouped by each user for each day.
	 * 2. all_users_per_day: Generates a report of transactions for all users combined for each day.
	 *
	 * @param \Symfony\Component\Console\Input\InputInterface $input
	 * @param \Symfony\Component\Console\Output\OutputInterface $output
	 * @throws \Exception if the report type is unknown
	 * @return int Exit code
	 */
	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$type = $input->getOption('type');

		if ($type == 'per_user_per_day') {
			$transactions = $this->transactionService->geTransactionsPerUserPerDateReport();
		} else if ($type == 'all_users_per_day') {
			$transactions = $this->transactionService->geTransactionsAllUsersPerDateReport();
		} else {
			throw new \Exception('Unknown type: ' . $type);
		}

		print_r($transactions);
		return Command::SUCCESS;
	}
}
