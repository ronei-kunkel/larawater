<?php declare(strict_types=1);

namespace Larawater\Drink\Application\Action;

use Larawater\Drink\Domain\Entity\User;
use Larawater\Drink\Infra\Repository\UserDrinkRepository;

final class UserDrink
{
  public function __construct(
    private UserDrinkRepository $repository
  ) {
  }

  public function handle(UserDrinkInput $input): false|User
  {
    $user = $this->repository->getById($input->userId);

    if(!$user) return false;

    $user->drink($input->quantity);

    if(!$this->repository->update($user)) return false;

    return $user;
  }
}