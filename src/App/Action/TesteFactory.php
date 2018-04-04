<?php

namespace App\Action;

use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TesteFactory
{
    public function __invoke(ContainerInterface $container)
    {

        $template = ($container->has(TemplateRendererInterface::class))
            ? $container->get(TemplateRendererInterface::class)
            : null;

        return new Teste($container->get('Doctrine\ORM\EntityManager'), $template);
    }
}
