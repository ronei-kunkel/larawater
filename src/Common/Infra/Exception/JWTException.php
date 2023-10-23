<?php declare(strict_types=1);

namespace Larawater\Common\Infra\Exception;

use Exception;

final class JWTException extends Exception
{
  public static function tokenCannotGenerate(): self
  {
    return new self('Token cannot generate.', 500);
  }

  public static function tokenCannotDecoded(): self
  {
    return new self('Token cannot decoded.', 500);
  }

  public static function specialException(string $message): self
  {
    $message = sprintf('%s', $message);
    return new self($message, 500);
  }
}