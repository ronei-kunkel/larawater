<?php declare(strict_types=1);

namespace Larawater\Module\Authorize\Application\Action;

final readonly class UserAuthorizeInput
{
  public function __construct(
    public string $email,
    public string $password
  ) {
  }
}