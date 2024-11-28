<?php

namespace App\Repository;

use App\Database\DBInterface;
use PDO;
use App\Entity\User;

class UserRepository implements UserRepositoryInterface
{
	private PDO $connection;

	public function __construct(DBInterface $connection)
	{
		$this->connection = $connection->getConnection();
	}

	public function create(User $user): void
	{
		$stmt = $this->connection->prepare('INSERT INTO users (name, credit) VALUES (:name, :credit)');
		$stmt->execute([
			'name' => $user->getName(),
			'credit' => $user->getCredit(),
		]);
		$user->setId((int)$this->connection->lastInsertId());
	}

	public function findAll(): array
	{
		$stmt = $this->connection->query('SELECT * FROM users');
		$rows = $stmt->fetchAll();
		$users = [];
		foreach ($rows as $row) {
			$users[] = new User($row['name'], $row['credit'], $row['id']);
		}
		return $users;
	}
}
