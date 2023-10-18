<?php declare(strict_types=1);

namespace Larawater\Module\Register\Application\Action;

use Larawater\Common\Domain\Exception\EmailException;
use Larawater\Common\Domain\Exception\PasswordException;
use Larawater\Module\Register\Application\Action\UserRegisterOutput;
use Larawater\Module\Register\Application\Exception\UserRegisterException;
use Larawater\Module\Register\Domain\Entity\User;
use Larawater\Module\Register\Infra\Repository\UserRegisterRepository;

final class UserRegister
{
  public function __construct(
    private UserRegisterRepository $repository
  ) {
  }

  /**
   * @throws UserRegisterException
   */
  public function handle(UserRegisterInput $input): UserRegisterOutput
  {
    try {

      $user = User::build($input->name, $input->email, $input->password);

    } catch (EmailException $e) {
      throw UserRegisterException::emailException($e->getMessage());
    } catch (PasswordException $e) {
      throw UserRegisterException::passwordException($e->getMessage());
    }

    $registered = $this->repository->create($user);

    if(!$registered)
      throw UserRegisterException::userNotCreated();

    return new UserRegisterOutput();
  }
}