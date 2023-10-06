<?php declare(strict_types=1);

namespace Larawater\Drink\Infra\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Larawater\Drink\Application\Action\UserDrink;
use Larawater\Drink\Application\Action\UserDrinkInput;

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

    $message = ['status' => 'Error'];
    $status  = 500;

    $input = new UserDrinkInput($data['user']['id'], $data['quantity'] ?? 1);

    $output = $this->action->handle($input);

    if (!$output) return response()->json($message, $status);

    $message = [
      'user'   => [
        'id'            => $output->id(),
        'name'          => $output->name(),
        'drink_counter' => $output->drinkCounter()
      ]
    ];
    $status  = 200;

    return response()->json($message, $status);
  }
}