<?php declare(strict_types=1);

namespace Larawater\Deploy\Application\Service;

final class DeployService
{
  public function run(): mixed
  {
    return exec('./../deploy.sh');
  }
}
