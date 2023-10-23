<?php declare(strict_types=1);

namespace Larawater\Module\Auth\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Larawater\Module\Auth\Application\Action\UserAuth;
use Larawater\Module\Auth\Application\Action\UserAuthInput;
use Larawater\Module\Auth\Application\Exception\UserAuthException;

final class UserAuthController
{

  public function __construct(
    private Request $request,
    private UserAuth $action
  ) {
  }

  public function __invoke(): JsonResponse
  {
    try {

      $data = $this->request->all();

      $input = new UserAuthInput($data['email'] ?? '', $data['password'] ?? '');

      $output = $this->action->handle($input);

      return new JsonResponse(['token' => $output->token], 200);

    } catch (UserAuthException $e) {
      return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }
  }
}