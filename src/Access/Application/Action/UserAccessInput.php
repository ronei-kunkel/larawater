<?php declare(strict_types=1);

namespace Larawater\Access\Application\Action;

final readonly class UserAccessInput
{
  public function __construct(
    public string $email,
    public string $password
  ) {
  }
}