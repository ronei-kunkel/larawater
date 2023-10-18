<?php declare(strict_types=1);

namespace Larawater\Documentation\Application\Action;

use Larawater\Common\Infra\Service\FileService;
use Larawater\Documentation\Infra\Page\DocumentationPage;

final class RawDocumentation
{

  public function __construct(
    private FileService $service
  ) {
  }

  public function handle(string $version = ''): string
  {
    $path = storage_path('api-spec/') . $version . '/' . $version . '.json';

    return $this->service->getContents($path);
  }
}