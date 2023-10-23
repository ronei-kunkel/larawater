<?php declare(strict_types=1);

namespace Larawater\Common\Domain\Exception;

use DomainException;

final class PasswordException extends DomainException
{

  public static function minLength(int $len): self
  {
    $message = sprintf('Password must be %s or more characters long', $len);

    return new self($message);
  }

  public static function specialCharMismatch(string $chars): self
  {
    $message = sprintf('Password must contain at least one of the special characters: %s', $chars);

    return new self($message);
  }

}