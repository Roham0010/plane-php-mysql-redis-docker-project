<?php

namespace App\Database;

use Exception;
use PDO;

class Database implements DBInterface
{
	private PDO $connection;

	public function __construct()
	{
		$config = require __DIR__ . '/../../config/database.php';

		$dsn = sprintf(
			'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
			$config['host'],
			$config['port'],
			$config['database']
		);

		try {
			$this->connection = new PDO($dsn, $config['username'], $config['password']);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			echo "An error occurred while connecting to the database: " . $e->getMessage() . "\n";
			throw $e;
		}
	}

	public function getConnection(): PDO
	{
		return $this->connection;
	}
}
