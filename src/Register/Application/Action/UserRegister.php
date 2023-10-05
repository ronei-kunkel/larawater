<?php declare(strict_types=1);

namespace Larawater\Register\Application\Action;

use Larawater\Register\Domain\Entity\User;
use Larawater\Register\Infra\Repository\UserRegisterRepository;

final class UserRegister
{
  public function __construct(
    private UserRegisterRepository $repository
  ) {
  }

  public function handle(UserRegisterInput $input): bool
  {
    $user = User::build($input->name, $input->email, $input->password);

    $execution = $this->repository->create($user);

    return $execution;
  }
}