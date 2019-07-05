<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerCreatePageAction
{
    private $template;

    private $repository;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(
        CustomerRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router
    ) {
        $this->repository  = $repository;
        $this->template = $template;
        $this->router = $router;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {

        $form = new CustomerForm();

        if ($request->getMethod() == 'POST') {
            $flash = $request->getAttribute('flash');
            $data = $request->getParsedBody();
            $form->setData($data);
            if ($form->isValid()) {
                $entity = $form->getData();
                $this->repository->create($entity);

                $flash->setMessage('success', 'Contato cadastrado com sucesso');

                $uri = $this->router->generateUri('customer.list');
                return new RedirectResponse($uri);
            }
        }

        return new HtmlResponse($this->template->render('app::customer/create', [
            'form' => $form,
        ]));
    }
}
