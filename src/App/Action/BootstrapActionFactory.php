<?php

namespace App\Action;

use App\Infraestructure\Bootstrap;
use Interop\Container\ContainerInterface;

class BootstrapActionFactory
{

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $bootstrap = new Bootstrap();
        return new BootstrapAction($bootstrap);
    }
}
