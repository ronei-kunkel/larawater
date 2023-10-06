<?php declare(strict_types=1);

namespace Larawater\Access\Domain\Entity;

use Larawater\Access\Domain\Type\Email;

final class User
{
  public function __construct(
    private int $id,
    private Email $email,
    private string $password,
  ) {
  }

  public function id(): int
  {
    return $this->id;
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