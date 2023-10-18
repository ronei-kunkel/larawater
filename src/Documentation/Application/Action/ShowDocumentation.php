<?php declare(strict_types=1);

namespace Larawater\Documentation\Application\Action;

use Larawater\Documentation\Infra\Page\DocumentationPage;

final class ShowDocumentation
{
  public function __construct(
    private DocumentationPage $documentationPage
  ) {
  }

  public function handle(string $version = ''): string
  {
    return $this->documentationPage->version($version);
  }
}