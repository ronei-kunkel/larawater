<?php declare(strict_types=1);

namespace Larawater\Module\Auth\Application\Service;

final class PasswordService
{
  public function verify(string $inputPassword, string $userPassword): bool
  {
    return password_verify($inputPassword, $userPassword);
  }
}