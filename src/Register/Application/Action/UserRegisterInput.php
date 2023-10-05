<?php declare(strict_types=1);

namespace Larawater\Register\Application\Action;

final readonly class UserRegisterInput
{
  public function __construct(
    public string $name,
    public string $email,
    public string $password
  ) {
  }
}