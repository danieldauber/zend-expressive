<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Infrastructure\Service\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

class AuthenticationMiddleware
{


    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(RouterInterface $router, AuthService $authService)
    {
        $this->router = $router;
        $this->authService = $authService;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if (!$this->authService->isAuth()) {
            $uri = $this->router->generateUri('auth.login');

            return new RedirectResponse($uri);
        }
        return $next($request, $response);
    }
}
