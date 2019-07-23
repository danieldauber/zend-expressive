<?php

namespace CodeEmailMKT\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Tag
{

    private $id;

    private $name;

    private $customers;

    private $campaigns;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
        $this->campaigns = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getCustomers() : Collection
    {
        return $this->customers;
    }

    /**
     * @return ArrayCollection
     */
    public function getCampaigns() : Collection
    {
        return $this->campaigns;
    }
}
