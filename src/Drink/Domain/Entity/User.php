<?php declare(strict_types=1);

namespace Larawater\Drink\Domain\Entity;

final class User
{
  public function __construct(
    private int $id,
    private string $name,
    private int $drinkCounter
  ) {
  }

  public function id(): int
  {
    return $this->id;
  }

  public function name(): string
  {
    return $this->name;
  }

  public function drinkCounter(): int
  {
    return $this->drinkCounter;
  }

  public function drink(int $drinks = 1): void
  {
    $this->drinkCounter += $drinks;
  }
}