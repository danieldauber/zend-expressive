<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository implements CustomerRepositoryInterface
{

    /**
     * @param $entity
     * @return $entity
     */
    public function create($entity)
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function update($entity)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function remove($entity)
    {
        // TODO: Implement remove() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function findAll()
    {
        return parent::findAll();
    }
}