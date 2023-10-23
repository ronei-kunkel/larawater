<?php declare(strict_types=1);

namespace Larawater\Common\Infra\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Larawater\Common\Infra\Exception\EnvException;
use Larawater\Common\Infra\Exception\JWTException;
use stdClass;
use Throwable;

final class JWTService
{

  private const ENV_VAR = 'JWT_KEY';

  private const ALG = 'HS256';

  public function __construct(
    private EnvService $envService
  ) {
  }

  /**
   * @throws EnvException
   */
  private function key(): string
  {
    return $this->envService->get(self::ENV_VAR);
  }

  /**
   * @throws JWTException
   */
  public function encode(int $userId, string $userEmail): string
  {
    $payload = [
      'id'    => $userId,
      'email' => $userEmail
    ];

    try {

      return JWT::encode($payload, $this->key(), self::ALG);

    } catch (EnvException $e) {
      throw JWTException::tokenCannotGenerate();
    }
  }

  /**
   * @throws JWTException
   */
  public function decode(string $jwt): stdClass
  {

    $jwt = str_replace("Bearer ", "", $jwt);

    try {

      return JWT::decode($jwt, new Key($this->key(), self::ALG));

    } catch (EnvException $e) {
      throw JWTException::tokenCannotDecoded();
    } catch (Throwable $th) {
      throw JWTException::specialException($th->getMessage());
    }
  }
}