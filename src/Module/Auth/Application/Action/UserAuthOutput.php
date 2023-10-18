<?php declare(strict_types=1);

namespace Larawater\Module\Auth\Application\Action;

final readonly class UserAuthOutput
{
  public function __construct(
    public string $token
  ) {
  }
}