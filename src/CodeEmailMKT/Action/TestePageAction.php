<?php

namespace CodeEmailMKT\Action;

use CodeEmailMKT\Entity\Category;
use CodeEmailMKT\Entity\Client;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use CodeEmailMKT\Entity\Address;

class TestePageAction
{

    private $template;

    private $manager;

    public function __construct(EntityManager $entityManager, Template\TemplateRendererInterface $template = null)
    {
        $this->manager  = $entityManager;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $client = new Client();
        $client->setName("Cliente 1");
        $client->setCpf("111111");
        $client->setEmail("email@email.com");
        $this->manager->persist($client);

        $address = new Address();
        $address->setCep("99999-000");
        $address->setCidade("Cidade");
        $address->setEstado("RS");
        $address->setLogradouro("Av Rua X 555");
        $address->setClient($client);
        $this->manager->persist($address);

        $address2 = new Address();
        $address2->setCep("99999-000");
        $address2->setCidade("Cidade 2");
        $address2->setEstado("RS");
        $address2->setLogradouro("Av Rua X 555");
        $address2->setClient($client);
        $this->manager->persist($address2);
        
        $this->manager->flush();

        $query = $this->manager->createQuery("SELECT c, a FROM CodeEmailMKT\Entity\Address a JOIN a.client c");
        $clients = $query->getResult();


        return new HtmlResponse($this->template->render('app::test-page', [
            'clients' => $clients,
        ]));
    }
}
