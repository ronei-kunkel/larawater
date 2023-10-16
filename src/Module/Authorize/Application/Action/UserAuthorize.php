<?php declare(strict_types=1);

namespace Larawater\Module\Authorize\Application\Action;

use Larawater\Common\Domain\Exception\EmailException;
use Larawater\Common\Infra\Exception\JWTException;
use Larawater\Module\Authorize\Application\Service\PasswordService;
use Larawater\Module\Authorize\Infra\Repository\UserAuthorizeRepository;
use Larawater\Common\Domain\Type\Email;
use Larawater\Common\Infra\Service\JWTService;
use Larawater\Module\Authorize\Application\Exception\UserAuthorizeException;

final class UserAuthorize
{
  public function __construct(
    private UserAuthorizeRepository $repository,
    private PasswordService $service,
    private JWTService $JWTService
  ) {
  }

  /**
   * @throws UserAuthorizeException
   */
  public function handle(UserAuthorizeInput $input): UserAuthorizeOutput
  {
    try {
      $email = new Email($input->email);
    } catch (EmailException $e) {
      throw UserAuthorizeException::invalidEmailFormat($input->email);
    }

    $user = $this->repository->getByEmail($email);

    if (!$user)
      throw UserAuthorizeException::wrongCredentials();

    if (!$this->service->verify($input->password, $user->password()))
      throw UserAuthorizeException::wrongCredentials();

    try {
      $jwt = 'Bearer ' . $this->JWTService->encode($user->id(), $user->email());

      return new UserAuthorizeOutput($jwt);

    } catch (JWTException $e) {
      throw UserAuthorizeException::tokenCannotGenerate();
    }

  }
}