<?php

namespace App\Repository;

use App\Entity\SkillLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SkillLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method SkillLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method SkillLevel[]    findAll()
 * @method SkillLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillLevelRepository extends ServiceEntityRepository
{
    /**
     * [__construct description]
     * @param RegistryInterface $registry [description]
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SkillLevel::class);
    }
}
