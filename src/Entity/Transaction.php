<?php

namespace App\Entity;

class Transaction
{
	private ?int $id;
	private int $userId;
	private float $amount;
	private string $date;

	public function __construct(int $userId, float $amount, string $date, int $id = null)
	{
		$this->id = $id;
		$this->userId = $userId;
		$this->amount = $amount;
		$this->date = $date;
	}

	// Getters
	public function getId(): ?int
	{
		return $this->id;
	}

	public function getUserId(): int
	{
		return $this->userId;
	}

	public function getAmount(): float
	{
		return $this->amount;
	}

	public function getDate(): string
	{
		return $this->date;
	}

	// Setters
	public function setId(int $id): void
	{
		$this->id = $id;
	}
}
