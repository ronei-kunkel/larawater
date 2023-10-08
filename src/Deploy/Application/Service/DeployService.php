<?php declare(strict_types=1);

namespace Larawater\Deploy\Application\Service;

final class DeployService
{
  public function run()
  {
    exec('./~/projects/larawater/deploy.sh');
  }
}
