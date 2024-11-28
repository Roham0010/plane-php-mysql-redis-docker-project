<?php

namespace App\Cache;

/**
 * Class CacheService
 *
 * @package App
 */
class CacheService implements CacheHandlerInterface
{
	private static ?\Redis $redis = null;

	public function __construct() {}

	private static function init(): void
	{
		if (self::$redis === null) {
			self::$redis = new \Redis();
			self::$redis->connect('redis', 6379);
		}
	}

	public static function get($key)
	{
		self::init();
		$cachedData = self::$redis->get($key);
		return $cachedData ? json_decode($cachedData, true) : null;
	}

	public static function set(string $key, mixed $data, int $ttl = 86400): void
	{
		self::init();
		self::$redis->setex($key, $ttl, json_encode($data));
	}

	public static function exists(string $key): bool
	{
		self::init();
		return self::$redis->exists($key);
	}
}
