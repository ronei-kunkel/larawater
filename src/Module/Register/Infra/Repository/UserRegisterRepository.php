<?php declare(strict_types=1);

namespace Larawater\Module\Register\Infra\Repository;

use Illuminate\Support\Facades\DB;
use Larawater\Module\Register\Domain\Entity\User;
use Throwable;

final class UserRegisterRepository
{
  public function create(User $user): bool
  {
    try {
      DB::transaction(function () use ($user) {
        DB::insert(
          'INSERT INTO user SET name = :name, email = :email, password = :password',
          [
            'name'     => $user->name(),
            'email'    => $user->email(),
            'password' => $user->password()
          ]
        );
      });
      return true;
    } catch (Throwable $th) {
      return false;
    }
  }

  public function getIdByEmail(string $email): ?int
  {
    $user = DB::selectOne('SELECT id FROM user WHERE email = :email',['email' => $email]);

    return $user->id ?? null;
  }
}