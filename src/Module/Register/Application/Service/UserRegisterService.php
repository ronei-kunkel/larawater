<?php declare(strict_types=1);

namespace Larawater\Module\Register\Application\Service;

use Larawater\Module\Register\Infra\Repository\UserRegisterRepository;

final class UserRegisterService
{

  public function __construct(
    private UserRegisterRepository $repository
  ) {
  }

  public function checkDuplicateEmail(string $email): bool
  {
    return ($this->repository->getIdByEmail($email)) ? true : false;
  }
}