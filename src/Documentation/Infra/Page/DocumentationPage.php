<?php declare(strict_types=1);

namespace Larawater\Documentation\Infra\Page;

use Illuminate\Support\Facades\View;
use Larawater\Common\Infra\Service\EnvService;

final class DocumentationPage
{

  public function __construct(
    private EnvService $envService
  ) {
  }

  public function version(string $version): string
  {
    return View::make(
      'documentation.index',
      [
        'rawDocumentation' => $this->envService->get('APP_URL') . '/api/documentation/' . $version,
        'styleUrl'         => 'https://raw.githubusercontent.com/swagger-api/swagger-ui/master/dist/swagger-ui.css',
        'scriptUrl'        => 'https://raw.githubusercontent.com/swagger-api/swagger-ui/master/dist/swagger-ui-bundle.js',
      ]
    )->render();
  }
}