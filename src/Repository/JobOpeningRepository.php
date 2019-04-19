<?php

namespace App\Repository;

use App\Entity\JobOpening;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JobOpening|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobOpening|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobOpening[]    findAll()
 * @method JobOpening[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobOpeningRepository extends ServiceEntityRepository
{
    /**
     * [__construct description]
     * @param RegistryInterface $registry [description]
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JobOpening::class);
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        return $this->createQueryBuilder('jo')
            ->andWhere('jo.published = :published')
            ->setParameter('published', true)
            ->orderBy('jo.updatedAt', 'DESC')
            ->getQuery()
            ->getArrayResult();
    }

}
