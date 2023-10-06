<?php declare(strict_types=1);

namespace Larawater\Module\Access\Infra\Repository;

use Illuminate\Support\Facades\DB;
use Larawater\Module\Access\Domain\Entity\User;
use Larawater\Common\Domain\Type\Email;
use Throwable;

final class UserAccessRepository
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

      return ($userData) ? new User($userData->id, $email, $userData->password) : false;
    } catch (Throwable $th) {
      return null;
    }
  }
}