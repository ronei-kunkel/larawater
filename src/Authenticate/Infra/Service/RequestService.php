<?php declare(strict_types=1);

namespace Larawater\Authenticate\Infra\Service;

use Illuminate\Http\Request;

final class RequestService
{
  public function verify(Request $request): bool
  {
    $header = $request->hasHeader('Authentication') ? $request->header('Authentication') : null;

    if (!$header) return false;

    return ($header === 'Authenticated') ? true : false;
  }
}