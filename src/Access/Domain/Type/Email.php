<?php declare(strict_types=1);

namespace Larawater\Access\Domain\Type;

final class Email
{
  public function __construct(
    private string $value
  ) {
    $this->value = $value;
  }

  public function value(): string
  {
    return $this->value;
  }
}