<?php

namespace CodeEmailMKT\Application\Action;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class TestePageAction
{

    private $template;

    private $repository;

    /**
     * TestePageAction constructor.
     * @param CustomerRepositoryInterface $repository
     * @param Template\TemplateRendererInterface|null $template
     */
    public function __construct(CustomerRepositoryInterface $repository, Template\TemplateRendererInterface $template = null)
    {
        $this->repository  = $repository;
        $this->template = $template;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param callable|null $next
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

        $customer = new Customer();
        $customer->setName("Daniel")
                 ->setEmail("emaiL@email.com");

        $this->repository->create($customer);

        $customers = $this->repository->findAll();

        return new HtmlResponse($this->template->render('app::test-page', [
            'customers' => $customers,
        ]));
    }
}
