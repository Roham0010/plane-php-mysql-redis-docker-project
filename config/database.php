<?php

if (getenv('APP_ENV') === 'test') {
	return [
		'host' => 'appdb_test',
		'port' => '3306',
		'database' => 'roomvu_project_test',
		'username' => getenv('MYSQL_USER') ?: 'user',
		'password' => getenv('MYSQL_PASSWORD') ?: 'password',
	];
}
return [
	'host' => getenv('MYSQL_HOST') ?: 'appdb1',
	'port' => getenv('MYSQL_PORT') ?: '33061',
	'database' => getenv('MYSQL_DATABASE') ?: 'roomvu_project1',
	'username' => getenv('MYSQL_USER') ?: 'user1',
	'password' => getenv('MYSQL_PASSWORD') ?: 'password1',
];
