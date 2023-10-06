<?php declare(strict_types=1);

namespace Larawater\Module\Drink\Infra\Repository;

use Illuminate\Support\Facades\DB;
use Larawater\Module\Drink\Domain\Entity\User;
use stdClass;
use Throwable;

final class UserDrinkRepository
{
  public function getById(int $id): ?User
  {
    try {

      $user = DB::selectOne(
        'SELECT id, name FROM user WHERE id = :id',
        [
          'id' => $id
        ]
      );

      $drink = DB::selectOne(
        'SELECT user_id, drink_counter FROM user_drink WHERE user_id = :id',
        [
          'id' => $id
        ]
      );

      if (!$user) return null;

      if (!$drink) {
        $drink = new stdClass();

        $drink->drink_counter = 0;
      }

      return new User($user->id, $user->name, $drink->drink_counter);
    } catch (Throwable $th) {
      return null;
    }
  }

  public function update(User $user): bool
  {
    try {

      DB::transaction(function () use ($user) {
        DB::insert(
          'INSERT INTO user_drink (user_id, drink_counter)
          VALUES (:user_id, :drink_counter)
          ON DUPLICATE KEY UPDATE
          drink_counter = VALUES(drink_counter)',
          [
            'user_id'       => $user->id(),
            'drink_counter' => $user->drinkCounter()
          ]
        );
      });

      return true;
    } catch (Throwable $th) {
      return false;
    }
  }
}