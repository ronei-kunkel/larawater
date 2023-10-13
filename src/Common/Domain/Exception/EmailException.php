<?php declare(strict_types=1);

namespace Larawater\Common\Domain\Exception;

use DomainException;

final class EmailException extends DomainException
{
  public static function invalidFormat(string $value) {
    $message = sprintf('The value \'%s\' has ain invalid email format', $value);

    return new self($message);
  }
}