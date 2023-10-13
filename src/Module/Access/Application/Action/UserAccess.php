<?php declare(strict_types=1);

namespace Larawater\Module\Access\Application\Action;

use Larawater\Common\Domain\Exception\EmailException;
use Larawater\Common\Infra\Exception\JWTException;
use Larawater\Module\Access\Application\Service\PasswordService;
use Larawater\Module\Access\Infra\Repository\UserAccessRepository;
use Larawater\Common\Domain\Type\Email;
use Larawater\Common\Infra\Service\JWTService;
use Larawater\Module\Access\Application\Exception\UserAccessException;

final class UserAccess
{
  public function __construct(
    private UserAccessRepository $repository,
    private PasswordService $service,
    private JWTService $JWTService
  ) {
  }

  /**
   * @throws UserAccessException
   */
  public function handle(UserAccessInput $input): UserAccessOutput
  {
    try {
      $email = new Email($input->email);
    } catch (EmailException $e) {
      throw UserAccessException::invalidEmailFormat($input->email);
    }

    $user = $this->repository->getByEmail($email);

    if (!$user)
      throw UserAccessException::wrongCredentials();

    if (!$this->service->verify($input->password, $user->password()))
      throw UserAccessException::wrongCredentials();

    try {
      $jwt = 'Bearer ' . $this->JWTService->encode($user->id(), $user->email());

      return new UserAccessOutput($jwt);

    } catch (JWTException $e) {
      throw UserAccessException::tokenCannotGenerate();
    }

  }
}