<?php declare(strict_types=1);

namespace Larawater\Module\Register\Application\Action;

final readonly class UserRegisterOutput
{
  public function __construct(
    public bool $registered
  ) {
  }
}