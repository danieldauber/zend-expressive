<?php
declare(strict_types = 1);
namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;

class CustomerRepository extends EntityRepository implements CustomerRepositoryInterface
{

    /**
     * @param $entity
     * @return  $entity
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($entity) : Customer
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update($entity) : Customer
    {
        if ($this->getEntityManager()->getUnitOfWork()->getEntityState($entity) != UnitOfWork::STATE_MANAGED) {
            $this->getEntityManager()->merge($entity);
        }

        $this->getEntityManager()->flush();
        return $entity;
    }

    /**
     * @param $entity
     * @return mixed
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove($entity)
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }


    public function find($id, $lockMode = null, $lockVersion = null) : Customer
    {
        return parent::find($id);
    }

    public function findAll() : array
    {
        return parent::findAll();
    }
}
