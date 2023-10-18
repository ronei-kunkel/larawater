<?php declare(strict_types=1);

namespace Larawater\Module\Auth\Application\Action;

use Larawater\Common\Domain\Exception\EmailException;
use Larawater\Common\Infra\Exception\JWTException;
use Larawater\Module\Auth\Application\Service\PasswordService;
use Larawater\Module\Auth\Infra\Repository\UserAuthRepository;
use Larawater\Common\Domain\Type\Email;
use Larawater\Common\Infra\Service\JWTService;
use Larawater\Module\Auth\Application\Exception\UserAuthException;

final class UserAuth
{
  public function __construct(
    private UserAuthRepository $repository,
    private PasswordService $service,
    private JWTService $JWTService
  ) {
  }

  /**
   * @throws UserAuthException
   */
  public function handle(UserAuthInput $input): UserAuthOutput
  {
    try {
      $email = new Email($input->email);
    } catch (EmailException $e) {
      throw UserAuthException::invalidEmailFormat($input->email);
    }

    $user = $this->repository->getByEmail($email);

    if (!$user)
      throw UserAuthException::wrongCredentials();

    if (!$this->service->verify($input->password, $user->password()))
      throw UserAuthException::wrongCredentials();

    try {
      $jwt = 'Bearer ' . $this->JWTService->encode($user->id(), $user->email());

      return new UserAuthOutput($jwt);

    } catch (JWTException $e) {
      throw UserAuthException::tokenCannotGenerate();
    }

  }
}