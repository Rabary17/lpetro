<?php

namespace App\Repository;

use App\Entity\UserSkill;
use App\Entity\Skill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSkill[]    findAll()
 * @method UserSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSkillRepository extends ServiceEntityRepository
{
    /**
     * Constructor
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserSkill::class);
    }

    /**
     * @param  string $userId description
     * @return array Returns an array of UserSkill objects
     */
    public function fetchByUser($userId): ?array
    {
        return $this->createQueryBuilder('us')
            ->andWhere('us.user = :user')
            ->setParameter('user', $userId)
            ->getQuery()
            ->getResult();
    }
}
