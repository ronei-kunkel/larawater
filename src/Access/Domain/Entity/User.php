<?php declare(strict_types=1);

namespace Larawater\Access\Domain\Entity;

use Larawater\Access\Domain\Type\Email;

final class User
{
  public function __construct(
    private Email $email,
    private string $password,
  ) {
  }

  public function email(): string
  {
    return $this->email->value();
  }

  public function password(): string
  {
    return $this->password;
  }
}