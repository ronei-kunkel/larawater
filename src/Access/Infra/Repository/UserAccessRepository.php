<?php declare(strict_types=1);

namespace Larawater\Access\Infra\Repository;

use Illuminate\Support\Facades\DB;
use Larawater\Access\Domain\Entity\User;
use Larawater\Access\Domain\Type\Email;
use Throwable;

final class UserAccessRepository
{
  public function getByEmail(Email $email): ?User
  {
    try {

      $userData = DB::selectOne(
        'SELECT email, password FROM user WHERE email = :email',
        [
          'email' => $email->value()
        ]
      );

      return ($userData) ? new User($email, $userData->password) : false;
    } catch (Throwable $th) {
      return null;
    }
  }
}