<?php

namespace App\Repository;

use App\Entity\Transaction;

interface TransactionRepositoryInterface
{
	public function create(Transaction $transaction): Transaction;
	public function findAll(): array;

	public function fetchAllUsersTransactionsPerDate(): array;
	public function fetchPerUserTransactionsPerDate(): array;
}
