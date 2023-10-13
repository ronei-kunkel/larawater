<?php declare(strict_types=1);

namespace Larawater\Module\Access\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Larawater\Module\Access\Application\Action\UserAccess;
use Larawater\Module\Access\Application\Action\UserAccessInput;
use Larawater\Module\Access\Application\Exception\UserAccessException;

final class UserAccessController
{

  public function __construct(
    private Request $request,
    private UserAccess $action
  ) {
  }

  public function __invoke(): Response
  {
    try {

      $data = $this->request->all();

      $input = new UserAccessInput($data['email'], $data['password']);

      $output = $this->action->handle($input);

      return response()->json(['token' => $output->token], 200);

    } catch (UserAccessException $e) {
      return response()->json(['error' => $e->getMessage()], $e->getCode());
    }
  }
}