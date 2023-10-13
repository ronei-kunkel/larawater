<?php declare(strict_types=1);

namespace Larawater\Module\Drink\Domain\Entity;
use Larawater\Module\Register\Domain\Exception\DrinkException;

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

  /**
   * @throws DrinkException
   */
  public function drink(int $drinks = 1): void
  {
    if ($drinks <= 0)
      throw DrinkException::onlyPositiveDrinksAllowed();

    $this->drinkCounter += $drinks;
  }
}