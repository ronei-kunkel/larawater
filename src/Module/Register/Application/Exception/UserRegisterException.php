<?php declare(strict_types=1);

namespace Larawater\Module\Register\Application\Exception;

use Exception;

final class UserRegisterException extends Exception
{
  public static function emailException(string $message) {
    return new self($message, 400);
  }

  public static function passwordException(string $message) {
    return new self($message, 400);
  }

  public static function userNotCreated() {
    return new self('User cannot created', 500);
  }

}