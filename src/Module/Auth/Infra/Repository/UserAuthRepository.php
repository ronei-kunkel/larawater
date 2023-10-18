<?php declare(strict_types=1);

namespace Larawater\Module\Auth\Infra\Repository;

use Illuminate\Support\Facades\DB;
use Larawater\Module\Auth\Domain\Entity\User;
use Larawater\Common\Domain\Type\Email;
use Throwable;

final class UserAuthRepository
{
  public function getByEmail(Email $email): ?User
  {
    try {

      $userData = DB::selectOne(
        'SELECT id, email, password FROM user WHERE email = :email',
        [
          'email' => $email->value()
        ]
      );

      return ($userData) ? new User($userData->id, $email, $userData->password) : null;
    } catch (Throwable $th) {
      return null;
    }
  }
}