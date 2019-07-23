<?php
declare(strict_types = 1);
namespace CodeEmailMKT\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Campaign
{

    private $id;

    private $name;

    private $template;

    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags() : Collection
    {
        return $this->tags;
    }

    public function addTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->getCampaigns()->add($this);
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTags(Collection $tags)
    {
        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->getCampaigns()->removeElement($this);
            $this->tags->removeElement($tag);
        }

        return $this;
    }
}
