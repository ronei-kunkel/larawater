<?php declare(strict_types=1);

namespace Larawater\Module\Authorize\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Larawater\Module\Authorize\Application\Action\UserAuthorize;
use Larawater\Module\Authorize\Application\Action\UserAuthorizeInput;
use Larawater\Module\Authorize\Application\Exception\UserAuthorizeException;

final class UserAuthorizeController
{

  public function __construct(
    private Request $request,
    private UserAuthorize $action
  ) {
  }

  public function __invoke(): Response
  {
    try {

      $data = $this->request->all();

      $input = new UserAuthorizeInput($data['email'], $data['password']);

      $output = $this->action->handle($input);

      return response()->json(['token' => $output->token], 200);

    } catch (UserAuthorizeException $e) {
      return response()->json(['error' => $e->getMessage()], $e->getCode());
    }
  }
}