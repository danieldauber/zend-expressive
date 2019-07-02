<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerUpdatePageAction
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

        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);

        if($request->getMethod() == 'PUT'){
            $data = $request->getParsedBody();

            $entity->setName($data['name']);
            $entity->setEmail($data['email']);

            $this->repository->update($entity);

            $flash = $request->getAttribute('flash');
            $flash->setMessage('success', 'Contato editado com sucesso');

            return new RedirectResponse('/admin/customers');

        }

        return new HtmlResponse($this->template->render('app::customer/update',[
            'customer' => $entity
        ]));
    }
}