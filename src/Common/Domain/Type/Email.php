<?php declare(strict_types=1);

namespace Larawater\Common\Domain\Type;

use Larawater\Common\Domain\Exception\EmailException;

final class Email
{
  public function __construct(
    private string $value
  ) {
    if(!filter_var($value, FILTER_VALIDATE_EMAIL))
      throw EmailException::invalidFormat($value);

    $this->value = $value;
  }

  public function value(): string
  {
    return $this->value;
  }
}