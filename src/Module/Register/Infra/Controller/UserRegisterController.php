<?php declare(strict_types=1);

namespace Larawater\Module\Register\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Larawater\Module\Register\Application\Action\UserRegister;
use Larawater\Module\Register\Application\Action\UserRegisterInput;
use Larawater\Module\Register\Application\Exception\UserRegisterException;

final class UserRegisterController
{

  public function __construct(
    private Request $request,
    private UserRegister $action
  ) {
  }

  public function __invoke(): JsonResponse
  {
    $data = $this->request->all();

    $input = new UserRegisterInput($data['name'] ?? '', $data['email'] ?? '', $data['password'] ?? '');

    try {

      $this->action->handle($input);

      return new JsonResponse(null, 201);

    } catch (UserRegisterException $e) {
      return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    }

  }
}