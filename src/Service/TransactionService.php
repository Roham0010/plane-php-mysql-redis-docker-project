<?php

namespace App\Service;

use App\Cache\CacheService;
use App\Entity\Transaction;
use App\Repository\TransactionRepositoryInterface;

class TransactionService
{
	private TransactionRepositoryInterface $transactionRepository;

	public function __construct(TransactionRepositoryInterface $transactionRepository)
	{
		$this->transactionRepository = $transactionRepository;
	}

	public function createTransaction(int $userId, float $amount, string $date): Transaction|null
	{
		try {
			// Delegate the transaction creation to the repository
			$transaction = new Transaction($userId, $amount, $date);
			return $this->transactionRepository->create($transaction);
		} catch (\Exception $e) {
			// Handle the exception as needed (log it, notify, etc.)
			echo "Transaction failed: " . $e->getMessage();
			return null;
		}
	}

	public function geTransactionsPerUserPerDateReport(): array
	{
		$report = $this->transactionRepository->fetchPerUserTransactionsPerDate();

		return $report;
	}

	public function geTransactionsAllUsersPerDateReport(): array
	{
		$cacheKey = "transactions_all_users_per_day";

		if (CacheService::exists($cacheKey)) {
			return CacheService::get($cacheKey);
		}


		$report = $this->transactionRepository->fetchAllUsersTransactionsPerDate();
		CacheService::set($cacheKey, $report);

		return $report;
	}

	public function getAllTransactions(): array
	{
		return $this->transactionRepository->findAll();
	}
}
