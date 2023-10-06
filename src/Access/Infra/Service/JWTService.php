<?php declare(strict_types=1);

namespace Larawater\Access\Infra\Service;

use Firebase\JWT\JWT;
use Larawater\Access\Domain\Entity\User;

final class JWTService
{
  public function encode(User $user): string
  {
    return JWT::encode(
      [
        'email' => $user->email(),
        'id' => $user->id()
      ],
      "JWTKEY",
      'HS256'
    );
  }
}