<?php

namespace App\Database;

use PDO;

interface DBInterface
{
	public function getConnection(): PDO;
}
