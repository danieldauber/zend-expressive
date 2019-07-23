<?php

namespace CodeEmailMKT\Application\Action\Campaign\Factory;

use CodeEmailMKT\Application\Action\Campaign\CampaignListPageAction;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;
use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignListPageFactory
{
    public function __invoke(ContainerInterface $container) : CampaignListPageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CampaignRepositoryInterface::class);
        $mailGun =  $container->get(Mailgun::class);

        return new CampaignListPageAction($repository, $template, $mailGun);
    }
}
