<?php declare(strict_types=1);

namespace Larawater\Deploy\Infra\Controller;

use Illuminate\Http\Request;
use Larawater\Deploy\Application\Service\DeployService;

final class DeployController
{
  public function __construct(
    private Request $request,
    private DeployService $service
  ) {
  }

  public function __invoke()
  {
    $this->service->run(); 
  }
}