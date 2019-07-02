<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerDeletePageAction
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

        if($request->getMethod() == 'DELETE'){
            $flash = $request->getAttribute('flash');
            $this->repository->remove($entity);
            $flash->setMessage('success', 'Contato removido com sucesso');

            return new RedirectResponse('/admin/customers');
        }

        return new HtmlResponse($this->template->render('app::customer/delete',[
            'customer' => $entity
        ]));
    }
}