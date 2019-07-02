<?php

namespace CodeEmailMKT\Application\Action\Customer;

use CodeEmailMKT\Domain\Entity\Customer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Zend\Form\Form;

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
    )
    {
        $this->repository  = $repository;
        $this->template = $template;
        $this->router = $router;
    }

    public function __invoke(ServerRequestInterface $request,
                             ResponseInterface $response, callable $next = null)
    {

//        $form = new CustomerForm();

        $myForm = new Form();

        $myForm->add([
            'name' => 'name',
            'type' => 'Text',
            'options' => [
                'label' => 'Nome'
            ],
            'attributes' => [
                'id'    =>  'name'
            ]
        ]);

        $myForm->add([
            'name' => 'email',
            'type' => 'Text',
            'options' => [
                'label' => 'E-mail'
            ],
            'attributes' => [
                'id' =>  'email'
            ]
        ]);

        $myForm->add([
            'name' => 'submit',
            'type' => 'Text',
            'attributes' => [
                'type' => 'submit'
            ],
            'options' => [
                'label' => 'Submit'
            ],
        ]);
//        $formHelper = $this->helperManager->get('form');

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

        return new HtmlResponse($this->template->render('app::customer/create', [
            'myForm' => $myForm,
//            'formHelper' => $formHelper
        ]));
    }
}