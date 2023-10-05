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

  public function __invoke(int $userId): Response
  {
    $message = ['status' => 'Error'];
    $status  = 500;

    if (!isset($userId) or !is_numeric($userId)) return response()->json($message, $status);

    $data = $this->request->all();

    $input = new UserDrinkInput($userId, $data['quantity'] ?? 1);

    $output = $this->action->handle($input);

    if (!$output) return response()->json($message, $status);

    $message = [
      'status' => 'Drinked',
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