<?php declare(strict_types=1);

namespace Larawater\Authenticate\Infra\Middleware;

use Closure;
use Illuminate\Http\Request;
use Larawater\Authenticate\Infra\Service\RequestService;

final class Authenticate
{

  public function __construct(
    private RequestService $service
  ) {
  }

  public function handle(Request $request, Closure $next)
  {
    return $this->service->verify($request) ? $next($request) : response()->json(['status' => 'Unauthorized'], 401);
  }
}