<?php

namespace App\Cache;

interface CacheHandlerInterface
{
	/**
	 * @param string $key
	 * @return mixed|null
	 */
	public static function get(string $key);

	/**
	 * @param string $key
	 * @param mixed  $data
	 * @param int    $ttl
	 * @return void
	 */
	public static function set(string $key, mixed $data, int $ttl = 86400);

	public static function exists(string $key): bool;
}
