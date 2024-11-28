<?php

namespace App\Database;

class Migrations
{
	public static function migrate(DBInterface $db): void
	{
		$connection = $db->getConnection();

		$queries = [
			"CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                credit DECIMAL(10, 2) NOT NULL DEFAULT 0
            )",
			"CREATE TABLE IF NOT EXISTS transactions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                amount DECIMAL(10, 2) NOT NULL,
                date DATE NOT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id),
                INDEX (user_id),
                INDEX (date)
            )",
		];

		foreach ($queries as $query) {
			$connection->exec($query);
		}
	}
}
