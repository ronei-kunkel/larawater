<?php declare(strict_types=1);

namespace Larawater\Auth\Infra\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

final class JWTService
{
  public function decode(string $jwt): false|stdClass
  {
    try {
      return JWT::decode($jwt, new Key('JWTKEY', 'HS256'));
    } catch (\Throwable $th) {
      return false;
    }
  }
}