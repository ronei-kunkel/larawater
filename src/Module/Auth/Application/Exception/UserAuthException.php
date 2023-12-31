<?php declare(strict_types=1);

namespace Larawater\Module\Auth\Application\Exception;

use Exception;

final class UserAuthException extends Exception
{
  public static function invalidEmailFormat(string $email): self
  {
    $message = sprintf('The email \'%s\' has an invalid format', $email);
    return new self($message, 400);
  }

  public static function wrongCredentials(): self
  {
    return new self('Wrong credentials. Try again or create an account instead if you don\'t have one', 401);
  }

  public static function tokenCannotGenerate(): self
  {
    return new self('Token cannot generate now. Try again later', 500);
  }

}