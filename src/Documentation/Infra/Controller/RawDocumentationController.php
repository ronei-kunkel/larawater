<?php declare(strict_types=1);

namespace Larawater\Documentation\Infra\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Larawater\Documentation\Application\Action\RawDocumentation;

final class RawDocumentationController
{
  public function __construct(
    private Request $request,
    private RawDocumentation $action
  ) {
  }

  public function __invoke(string $version = ''): JsonResponse
  {
    $output = $this->action->handle($version);

    return new JsonResponse(json_decode($output));
  }
}