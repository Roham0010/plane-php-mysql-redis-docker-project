<?php

namespace App\Entity;

class User
{
	private ?int $id;
	private string $name;
	private float $credit;

	public function __construct(string $name, float $credit, int $id = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->credit = $credit;
	}

	// Getters
	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getCredit(): float
	{
		return $this->credit;
	}

	// Setters
	public function setId(int $id): void
	{
		$this->id = $id;
	}
}
