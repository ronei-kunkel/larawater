<?php declare(strict_types=1);

namespace Larawater\Module\Drink\Application\Exception;

use Exception;

final class UserDrinkException extends Exception
{
  public static function drinkException(string $message): self
  {
    return new self($message, 400);
  }

  public static function userNotFound(): self
  {
    return new self('User not found', 404);
  }

  public static function cannotUpdateUserDrinkCounter(): self
  {
    return new self('Cannot update user drink counter', 500);
  }
}