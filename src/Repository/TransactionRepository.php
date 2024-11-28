<?php

namespace App\Repository;

use App\Database\DBInterface;
use PDO;
use App\Entity\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
	private PDO $connection;

	public function __construct(DBInterface $connection)
	{
		$this->connection = $connection->getConnection();
	}

	public function create(Transaction $transaction): Transaction
	{
		// Start transaction
		$this->connection->beginTransaction();

		try {
			// Get and Lock the user record for updating
			$stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id FOR UPDATE");
			$stmt->execute(['id' => $transaction->getUserId()]);
			$user = $stmt->fetch();

			if (!$user) {
				throw new \Exception('User not found');
			}

			if ($user['credit'] < $transaction->getAmount()) {
				throw new \Exception('Insufficient credit');
			}

			// Update user credit
			$stmt = $this->connection->prepare("UPDATE users SET credit = credit - :amount WHERE id = :id");
			$stmt->execute(['amount' => $transaction->getAmount(), 'id' => $transaction->getUserId()]);

			// Create transaction
			$stmt = $this->connection->prepare('INSERT INTO transactions (user_id, amount, date) VALUES (:user_id, :amount, :date)');
			$stmt->execute([
				'user_id' => $transaction->getUserId(),
				'amount' => $transaction->getAmount(),
				'date' => $transaction->getDate(),
			]);
			$transaction->setId((int)$this->connection->lastInsertId());

			$this->connection->commit();

			return $transaction;
		} catch (\Exception $e) {
			$this->connection->rollBack();
			throw $e;
		}
	}

	/**
	 *
	 * Fetch all transactions grouped by date with the total amount of each day
	 *
	 * @throws \Exception
	 * @return array
	 */
	public function fetchAllUsersTransactionsPerDate(): array
	{
		$query = "
				SELECT date, SUM(amount) as total_amount
				FROM transactions t
				GROUP BY date
				order by date desc
			";

		$stmt = $this->connection->prepare($query);
		$stmt->execute();

		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	/**
	 * Fetch all transactions per user grouped by date with the total amount of each day
	 *
	 * @return array
	 */
	public function fetchPerUserTransactionsPerDate(): array
	{
		$query = "
				SELECT name, user_id, date, SUM(amount) as total_amount
				FROM users u join transactions t on u.id = t.user_id
				GROUP BY user_id, date
				order by date desc
			";

		$stmt = $this->connection->prepare($query);
		$stmt->execute();

		$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	public function findAll(): array
	{
		$stmt = $this->connection->query('SELECT * FROM transactions');
		$rows = $stmt->fetchAll();
		$transactions = [];
		foreach ($rows as $row) {
			$transactions[] = new Transaction($row['user_id'], $row['amount'], $row['date'], $row['id']);
		}
		return $transactions;
	}
}
