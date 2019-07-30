<?php
declare(strict_types = 1);
namespace CodeEmailMKT\Infrastructure\Service;

use CodeEmailMKT\Domain\Entity\Campaign;
use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Entity\Tag;
use CodeEmailMKT\Domain\Service\CampaignEmailSenderInterface;
use Mailgun\Mailgun;
use Mailgun\Messages\BatchMessage;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignEmailSender implements CampaignEmailSenderInterface
{

    /** @var Campaign $campaign */
    private $campaign;
    /**
     * @var TemplateRendererInterface $templateRenderer
     */
    private $templateRenderer;
    /**
     * @var array $mailGunConfig
     */
    private $mailGunConfig;
    /**
     * @var Mailgun $mailgun
     */
    private $mailgun;

    public function __construct(TemplateRendererInterface $templateRenderer, Mailgun $mailgun, array $mailGunConfig)
    {
        $this->templateRenderer = $templateRenderer;
        $this->mailGunConfig = $mailGunConfig;
        $this->mailgun = $mailgun;
    }


    public function setCampaign(Campaign $campaign) : CampaignEmailSender
    {
        $this->campaign = $campaign;
        return $this;
    }

    public function send()
    {

        /** @var Tag $tag */
        $tags = $this->campaign->getTags()->toArray();
        $batchMessage = $this->getBatchMessage();

        foreach ($tags as $tag) {
            $customers = $tag->getCustomers()->toArray();
            $batchMessage->addTag($tag->getName());
            /** @var Customer $customer */
            foreach ($customers as $customer) {
                $name = (!$customer->getName() or $customer->getName() == '')
                    ? $customer->getEmail() : $customer->getName();
                $batchMessage->addToRecipient($customer->getEmail(), ['full_name' => $name]);
            }
        }
        $batchMessage->finalize();
    }

    private function getBatchMessage() : BatchMessage
    {
        $batchMessage = $this->mailgun->BatchMessage($this->mailGunConfig['domain']);
        $batchMessage->addCampaignId("campaign_{$this->campaign->getId()}");
        $batchMessage->setFromAddress('web@dauber.com.br', ['full_name' => 'Daniel Dauber']);
        $batchMessage->setSubject($this->campaign->getSubject());
        $batchMessage->setHtmlBody($this->getHtmlBody());

        return $batchMessage;
    }

    private function getHtmlBody() : string
    {
        $template = $this->campaign->getTemplate();
        return $this->templateRenderer->render('app::campaign/_campaign_template', [
           'content' => $template
        ]);
    }
}
