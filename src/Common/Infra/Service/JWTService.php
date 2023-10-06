<?php declare(strict_types=1);

namespace Larawater\Common\Infra\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

final class JWTService
{
  private const JWTKEY = 'JWTKEY';

  public function encode(int $userId, string $userEmail): string
  {
    return JWT::encode(
      [
        'id' => $userId,
        'email' => $userEmail
      ],
      self::JWTKEY,
      'HS256'
    );
  }

  public function decode(string $jwt): false|stdClass
  {
    try {
      return JWT::decode($jwt, new Key(self::JWTKEY, 'HS256'));
    } catch (\Throwable $th) {
      return false;
    }
  }
}