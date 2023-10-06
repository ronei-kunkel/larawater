<?php declare(strict_types=1);

namespace Larawater\Module\Access\Application\Action;

use Larawater\Module\Access\Application\Service\PasswordService;
use Larawater\Module\Access\Infra\Repository\UserAccessRepository;
use Larawater\Common\Domain\Type\Email;
use Larawater\Common\Infra\Service\JWTService;

final class UserAccess
{
  public function __construct(
    private UserAccessRepository $repository,
    private PasswordService $service,
    private JWTService $jwtService
  ) {
  }

  public function handle(UserAccessInput $input): false|UserAccessOutput
  {
    $email = new Email($input->email);

    $user = $this->repository->getByEmail($email);

    if (!$user) return false;

    if (!$this->service->verify($input->password, $user->password())) return false;

    $jwt = $this->jwtService->encode($user->id(), $user->email());

    return new UserAccessOutput($jwt);
  }
}