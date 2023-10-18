<?php declare(strict_types=1);

namespace Larawater\Common\Infra\Service;

final class FileService
{

  public function getContents(string $path): string
  {
    return file_get_contents($path);
  }
}