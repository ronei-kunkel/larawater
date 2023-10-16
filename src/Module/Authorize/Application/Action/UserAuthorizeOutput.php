<?php declare(strict_types=1);

namespace Larawater\Module\Authorize\Application\Action;

final readonly class UserAuthorizeOutput
{
  public function __construct(
    public string $token
  ) {
  }
}