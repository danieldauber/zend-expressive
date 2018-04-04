<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;

class Teste
{
    private $router;

    private $template;

    private $manager;

    public function __construct(EntityManager $manager,Template\TemplateRendererInterface $template = null)
    {
        $this->manager = $manager;
        $this->template = $template;

    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $data = [];

        return new HtmlResponse($this->template->render('app::teste', $data));
    }
}
