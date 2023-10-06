<?php declare(strict_types=1);

namespace Larawater\Access\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Larawater\Access\Application\Action\UserAccess;
use Larawater\Access\Application\Action\UserAccessInput;

final class UserAccessController
{

  public function __construct(
    private Request $request,
    private UserAccess $action
  ) {
  }

  public function __invoke(): Response
  {
    $data = $this->request->all();

    $input = new UserAccessInput($data['email'], $data['password']);

    $output = $this->action->handle($input);

    if(!$output) return response()->json(['error' => 'Wrong credentials'], 401);

    return response()->json(['token' => $output->token], 200);
  }
}