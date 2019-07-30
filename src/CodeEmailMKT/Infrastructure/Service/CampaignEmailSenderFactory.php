<?php

namespace CodeEmailMKT\Infrastructure\Service;

use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignEmailSenderFactory
{
    public function __invoke(ContainerInterface $container) : CampaignEmailSender
    {
        $template = $container->get(TemplateRendererInterface::class);
        $mailGun = $container->get(Mailgun::class);
        $mailGunConfig = $container->get('config')['mailgun'];

        return new CampaignEmailSender($template, $mailGun, $mailGunConfig);
    }
}
