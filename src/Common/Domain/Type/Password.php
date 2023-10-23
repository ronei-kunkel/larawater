<?php declare(strict_types=1);

namespace Larawater\Common\Domain\Type;

use Larawater\Common\Domain\Exception\PasswordException;

final class Password
{

  private const MIN_LENGHT = 8;

  private const SPECIAL_CHARS = '!@#$%&*()_-+=?';

  public function __construct(
    private string $value
  ) {

    if(strlen($value) < self::MIN_LENGHT)
      throw PasswordException::minLength(self::MIN_LENGHT);

    if(!preg_match('/['.preg_quote(self::SPECIAL_CHARS, '/').']/', $value))
      throw PasswordException::specialCharMismatch(self::SPECIAL_CHARS);

    $this->value = password_hash($value, PASSWORD_ARGON2ID);
  }

  public function value(): string
  {
    return $this->value;
  }
}