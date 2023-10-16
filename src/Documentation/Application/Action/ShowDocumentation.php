<?php declare(strict_types=1);

namespace Larawater\Documentation\Application\Action;

final class ShowDocumentation
{
  public function __construct(
    // private DocumentationPage $documentationPage
  ) {
  }

  public function handle(string $version = ''): string
  {
    return 'doc: '. $version;//$this->documentationPage->version($version);
  }
}