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

class LoginPageAction
{
    private $router;

    private $template;
    /**
     * @var LoginForm
     */
    private $form;
    /**
     * @var AuthService
     */
    private $authService;

    public function __construct(
        Router\RouterInterface $router,
        Template\TemplateRendererInterface $template,
        LoginForm $form,
        AuthInterface $authService
    ) {
        $this->router   = $router;
        $this->template = $template;
        $this->form = $form;
        $this->authService = $authService;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {

        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $user = $this->form->getData();

                if ($this->authService->authenticate($user['email'], $user['password'])) {
                    $uri = $this->router->generateUri('customer.list');
                    return new RedirectResponse($uri);
                }
            }
        }

        return new HtmlResponse($this->template->render('app::login/login', [
            'form' => $this->form
        ]));
    }
}
