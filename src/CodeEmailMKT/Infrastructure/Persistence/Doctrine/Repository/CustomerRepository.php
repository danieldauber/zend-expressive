<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;

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
        if($this->getEntityManager()->getUnitOfWork()->getEntityState($entity) != UnitOfWork::STATE_MANAGED) {
            $this->getEntityManager()->merge($entity);
        }

        $this->getEntityManager()->flush();
        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function remove($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }


    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id);
    }

    public function findAll()
    {
        return parent::findAll();
    }
}