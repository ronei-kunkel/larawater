<?php declare(strict_types=1);

namespace Larawater\Access\Application\Action;

use Larawater\Access\Application\Service\PasswordService;
use Larawater\Access\Domain\Entity\User;
use Larawater\Access\Domain\Type\Email;
use Larawater\Access\Infra\Repository\UserAccessRepository;

final class UserAccess
{
  public function __construct(
    private UserAccessRepository $repository,
    private PasswordService $service
  ) {
  }

  public function handle(UserAccessInput $input): bool
  {
    $email = new Email($input->email);

    $user = $this->repository->getByEmail($email);

    return ($user) ? $this->service->verify($input->password, $user->password()) : false;
  }
}