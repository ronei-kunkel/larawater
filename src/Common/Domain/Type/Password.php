<?php declare(strict_types=1);

namespace Larawater\Common\Domain\Type;

final class Password
{
  public function __construct(
    private string $value
  ) {
    $this->value = password_hash($value, PASSWORD_ARGON2ID);
  }

  public function value(): string
  {
    return $this->value;
  }
}