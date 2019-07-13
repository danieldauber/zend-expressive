<?php

namespace CodeEmailMKT\Application\Action\Login;

use CodeEmailMKT\Application\Form\LoginForm;
use CodeEmailMKT\Domain\Service\AuthInterface;
use CodeEmailMKT\Infrastructure\Service\AuthService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class LogoutAction
{
    private $router;
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(
        Router\RouterInterface $router,
        AuthInterface $authService
    ) {
        $this->router   = $router;
        $this->authService = $authService;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {

        $this->authService->destroy();

        $uri = $this->router->generateUri('auth.login');
        return new RedirectResponse($uri);
    }
}
