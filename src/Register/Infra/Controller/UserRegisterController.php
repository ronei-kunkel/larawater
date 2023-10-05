<?php declare(strict_types=1);

namespace Larawater\Register\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Larawater\Register\Application\Action\UserRegister;
use Larawater\Register\Application\Action\UserRegisterInput;

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

    $output = $this->action->handle($input);

    $message = $output ? null : ['status' => 'Error'];
    $status  = $output ? 200 : 500;

    return response()->json($message, $status);
  }
}