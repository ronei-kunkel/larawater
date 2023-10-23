<?php declare(strict_types=1);

namespace Larawater\Module\Register\Application\Exception;

use Exception;

final class UserRegisterException extends Exception
{
  public static function emailException(string $message): self
  {
    return new self($message, 400);
  }

  public static function passwordException(string $message): self
  {
    return new self($message, 400);
  }

  public static function emailAlredyInUse(): self
  {
    return new self('The email are already in use', 409);
  }

  public static function userNotCreated(): self
  {
    return new self('User cannot created', 500);
  }

}