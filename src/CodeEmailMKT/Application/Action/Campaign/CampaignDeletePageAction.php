<?php

namespace CodeEmailMKT\Application\Action\Campaign;

use CodeEmailMKT\Application\Form\CampaignForm;
use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\Form\MethodElement;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;

class CampaignDeletePageAction
{
    private $template;

    private $repository;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CustomerForm
     */
    private $form;

    public function __construct(
        CampaignRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CampaignForm $form
    ) {
        $this->repository  = $repository;
        $this->template = $template;
        $this->router = $router;
        $this->form = $form;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {

        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);

        $this->form->add(new MethodElement('DELETE'));
        $this->form->bind($entity);

        if ($request->getMethod() == 'DELETE') {
            $flash = $request->getAttribute('flash');
            $this->repository->remove($entity);
            $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, 'Campanha removida com sucesso');

            $uri = $this->router->generateUri('campaign.list');
            return new RedirectResponse($uri);
        }

        return new HtmlResponse($this->template->render('app::campaign/delete', [
            'form' => $this->form
        ]));
    }
}