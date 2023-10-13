<?php declare(strict_types=1);

namespace Larawater\Common\Infra\Middleware;

use Closure;
use Illuminate\Http\Request;
use Larawater\Common\Infra\Exception\JWTException;
use Larawater\Common\Infra\Service\JWTService;

final class AuthMiddleware
{

  public function __construct(
    private JWTService $jWTService
  ) {
  }

  public function handle(Request $request, Closure $next)
  {
    $jwt = $request->hasHeader('Authorization') ? $request->header('Authorization') : null;

    if (!$jwt) return response()->json(['error' => "Missing 'Authorization' header"], 400);

    try {
      $user = $this->jWTService->decode($jwt);

      $request->merge([
        'user' => [
          'id'    => $user->id,
          'email' => $user->email
        ]
      ]);

      return $next($request);

    } catch (JWTException $e) {
      return response()->json(['error' => $e->getMessage()], $e->getCode());
    }

  }
}