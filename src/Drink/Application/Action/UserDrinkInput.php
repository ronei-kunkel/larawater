<?php declare(strict_types=1);

namespace Larawater\Drink\Application\Action;

final readonly class UserDrinkInput
{
  public function __construct(
    public int $userId,
    public int $quantity
  ) {
  }
}