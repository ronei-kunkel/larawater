<?php declare(strict_types=1);

namespace Larawater\Module\Register\Infra\Repository;

use Exception;
use Illuminate\Support\Facades\DB;
use Larawater\Module\Register\Domain\Entity\User;
use Throwable;

final class UserRegisterRepository
{
  public function create(User $user): bool
  {

    return DB::transaction(function () use ($user) {
        DB::insert(
          'INSERT INTO user SET name = :name, email = :email, password = :password',
          [
            'name'     => $user->name(),
            'email'    => $user->email(),
            'password' => $user->password()
          ]
        );
      });
  }
}