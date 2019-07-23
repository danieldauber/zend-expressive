<?php
declare(strict_types = 1);
namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use CodeEmailMKT\Domain\Entity\Campaign;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\UnitOfWork;

class CampaignRepository extends EntityRepository implements CampaignRepositoryInterface
{

    /**
     * @param $entity
     * @return  $entity
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create($entity) : Campaign
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
    public function update($entity) : Campaign
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


    public function find($id, $lockMode = null, $lockVersion = null) : Campaign
    {
        return parent::find($id);
    }

    public function findAll() : array
    {
        return parent::findAll();
    }
}
