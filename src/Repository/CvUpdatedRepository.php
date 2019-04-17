<?php

namespace App\Repository;

use App\Entity\CvUpdated;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CvUpdated|null find($id, $lockMode = null, $lockVersion = null)
 * @method CvUpdated|null findOneBy(array $criteria, array $orderBy = null)
 * @method CvUpdated[]    findAll()
 * @method CvUpdated[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CvUpdatedRepository extends ServiceEntityRepository
{
    /**
     * [__construct description]
     * @param RegistryInterface $registry [description]
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CvUpdated::class);
    }

    /**
     * @return CvUpdated[] Returns an array of CvUpdated objects
     */
    public function fetchByCandidat($value)
    {
        return $this->createQueryBuilder('uc')
            ->andWhere('uc.user = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?CvUpdated
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
