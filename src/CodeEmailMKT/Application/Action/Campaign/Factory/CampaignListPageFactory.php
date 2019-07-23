<?php

namespace CodeEmailMKT\Application\Action\Campaign\Factory;

use CodeEmailMKT\Application\Action\Campaign\CampaignListPageAction;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignListPageFactory
{
    public function __invoke(ContainerInterface $container) : CampaignListPageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CampaignRepositoryInterface::class);

        return new CampaignListPageAction($repository, $template);
    }
}
