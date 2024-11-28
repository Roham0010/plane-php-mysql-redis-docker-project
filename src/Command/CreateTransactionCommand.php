<?php

namespace App\Command;

use App\Service\TransactionService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTransactionCommand extends Command
{
	private TransactionService $transactionService;

	public function __construct(TransactionService $transactionService)
	{
		parent::__construct('app:create-transaction');
		$this->transactionService = $transactionService;
	}


	protected function configure()
	{
		$this->setDescription('Creates a transaction for a user on a specific day.')
			->addOption('user-id', null, InputOption::VALUE_REQUIRED, 'User ID')
			->addOption('amount', null, InputOption::VALUE_REQUIRED, 'Transaction amount')
			->addOption('date', null, InputOption::VALUE_OPTIONAL, 'Transaction date (YYYY-MM-DD)');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$userId = (int) $input->getOption('user-id');
		$amount = (float) $input->getOption('amount');
		$date =	$input->getOption('date') ?: date("Y-m-d H:i:s");

		// TODO: Validations(I think it's not needed for a test task..)

		$this->transactionService->createTransaction($userId, $amount, $date);

		$output->writeln('Transaction created successfully.');
		return Command::SUCCESS;
	}
}
