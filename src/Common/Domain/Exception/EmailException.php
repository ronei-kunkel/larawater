<?php declare(strict_types=1);

namespace Larawater\Common\Domain\Exception;

use DomainException;

final class EmailException extends DomainException
{
  public static function invalidFormat(string $value): self
  {
    $message = sprintf('The email value \'%s\' has an invalid format', $value);

    return new self($message);
  }
}