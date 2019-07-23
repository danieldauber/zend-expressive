<?php

namespace CodeEmailMKT\Infrastructure\Service;

use Interop\Container\ContainerInterface;

class CampaignEmailSenderFactory
{
    public function __invoke(ContainerInterface $container) : CampaignEmailSender
    {
        return new CampaignEmailSender();
    }
}
