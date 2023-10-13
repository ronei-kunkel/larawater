<?php declare(strict_types=1);

namespace Larawater\Common\Infra\Exception;

use Exception;

final class EnvException extends Exception
{
  public static function varNotExist(string $var) {
    $message = sprintf('The env var \'%s\' not exist.', $var);

    return new self($message);
  }

  public static function varIsNull(string $var) {
    $message = sprintf('The env var \'%s\' is null.', $var);

    return new self($message);
  }
}