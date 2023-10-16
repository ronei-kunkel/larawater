<?php declare(strict_types=1);

namespace Larawater\Module\Register\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
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

  public function __invoke(): Response
  {
    $data = $this->request->all();

    $input = new UserRegisterInput($data['name'], $data['email'], $data['password']);

    try {

      $this->action->handle($input);

      return response()->json(['message' => 'Created'], 201);

    } catch (UserRegisterException $e) {
      return response()->json(['error' => $e->getMessage()], $e->getCode());
    }

  }
}