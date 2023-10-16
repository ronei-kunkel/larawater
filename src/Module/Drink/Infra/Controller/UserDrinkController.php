<?php declare(strict_types=1);

namespace Larawater\Module\Drink\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Larawater\Module\Drink\Application\Action\UserDrink;
use Larawater\Module\Drink\Application\Action\UserDrinkInput;
use Larawater\Module\Drink\Application\Exception\UserDrinkException;

final class UserDrinkController
{

  public function __construct(
    private Request $request,
    private UserDrink $action
  ) {
  }

  public function __invoke(): Response
  {
    $data = $this->request->all();

    $input = new UserDrinkInput($data['user']['id'], $data['quantity'] ?? 1);

    try {
      $user = $this->action->handle($input);

      $message = [
        'user'   => [
          'id'            => $user->id(),
          'name'          => $user->name(),
          'drink_counter' => $user->drinkCounter()
        ]
      ];

      return response()->json($message, 200);

    } catch (UserDrinkException $e) {
      return response()->json(['error' => $e->getMessage()], $e->getCode());
    }

  }
}