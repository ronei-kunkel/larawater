<?php declare(strict_types=1);

namespace Larawater\Module\Drink\Application\Action;

use Larawater\Module\Drink\Application\Exception\UserDrinkException;
use Larawater\Module\Drink\Domain\Entity\User;
use Larawater\Module\Drink\Domain\Exception\DrinkException;
use Larawater\Module\Drink\Infra\Repository\UserDrinkRepository;
final class UserDrink
{
  public function __construct(
    private UserDrinkRepository $repository
  ) {
  }

  /**
   * @throws UserDrinkException
   */
  public function handle(UserDrinkInput $input): User
  {
    $user = $this->repository->getById($input->userId);

    if(!$user)
      throw UserDrinkException::userNotFound();

    try {

      $user->drink($input->quantity);

    } catch (DrinkException $e) {
      throw UserDrinkException::drinkException($e->getMessage());
    }

    if(!$this->repository->update($user))
      throw UserDrinkException::cannotUpdateUserDrinkCounter();

    return $user;
  }
}