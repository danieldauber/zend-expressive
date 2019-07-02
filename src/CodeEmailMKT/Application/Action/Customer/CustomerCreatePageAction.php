<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Zend\Form\View\Helper\Form;

class CustomerCreatePageAction
{
    private $template;

    private $repository;

    public function __construct(CustomerRepositoryInterface $repository, Template\TemplateRendererInterface $template = null)
    {
        $this->repository  = $repository;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

        if($request->getMethod() == 'POST'){
            $flash = $request->getAttribute('flash');
            $data = $request->getParsedBody();

            $entity = new Customer();
            $entity->setName($data['name']);
            $entity->setEmail($data['email']);

            $this->repository->create($entity);

            $flash->setMessage('success', 'Contato cadastrado com sucesso');

            return new RedirectResponse('/admin/customers');

        }

        return new HtmlResponse($this->template->render('app::customer/create'));
    }
}