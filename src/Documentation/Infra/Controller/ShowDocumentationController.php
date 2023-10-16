<?php declare(strict_types=1);

namespace Larawater\Documentation\Infra\Controller;

use Illuminate\Http\Request;
use Larawater\Documentation\Application\Action\ShowDocumentation;

final class ShowDocumentationController
{
  public function __construct(
    private Request $request,
    private ShowDocumentation $action
  ) {
  }

  public function __invoke(string $version = '')
  {
    $output = $this->action->handle($version);

    return response($output);
  }
}