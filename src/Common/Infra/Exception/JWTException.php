<?php declare(strict_types=1);

namespace Larawater\Common\Infra\Exception;

use Exception;

final class JWTException extends Exception
{
  public static function tokenCannotGenerate() {
    return new self('Token cannot generate.', 500);
  }

  public static function tokenCannotDecoded() {
    return new self('Token cannot decoded.', 500);
  }

  public static function temporaryGenericJWTException(string $message) {
    $message = sprintf('Temporary generic: %s', $message);
    return new self($message, 500);
  }
}