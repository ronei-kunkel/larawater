<?php declare(strict_types=1);

namespace Larawater\Module\Auth\Application\Action;

final readonly class UserAuthInput
{
  public function __construct(
    public string $email,
    public string $password
  ) {
  }
}