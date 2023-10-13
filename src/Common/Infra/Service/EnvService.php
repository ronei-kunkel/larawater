<?php declare(strict_types=1);

namespace Larawater\Common\Infra\Service;

use Larawater\Common\Infra\Exception\EnvException;

final class EnvService
{
  public function get(string $var): mixed
  {
    if(!isset($_ENV[$var]))
      throw EnvException::varNotExist($var);

    if(is_null($_ENV[$var]))
      throw EnvException::varIsNull($var);

    return $_ENV[$var];
  }
}