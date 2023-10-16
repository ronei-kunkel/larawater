<?php declare(strict_types=1);

namespace Larawater\Module\Authorize\Application\Exception;

use Exception;

final class UserAuthorizeException extends Exception
{
  public static function invalidEmailFormat(string $email) {
    $message = sprintf('The email \'%s\' has an invalid format', $email);
    return new self($message, 400);
  }

  public static function wrongCredentials() {
    return new self('Wrong credentials. Try again or create an account instead if you don\'t have one', 401);
  }

  public static function tokenCannotGenerate() {
    return new self('Token cannot generate now. Try again later', 500);
  }

}