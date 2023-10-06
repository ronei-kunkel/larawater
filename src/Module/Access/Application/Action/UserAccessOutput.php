<?php declare(strict_types=1);

namespace Larawater\Module\Access\Application\Action;

final readonly class UserAccessOutput
{
  public function __construct(
    public string $token
  ) {
  }
}