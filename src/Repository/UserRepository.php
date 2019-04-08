<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{

    /**
     * Constructor
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return array
     */
    public function fetchAllRecentCandidates()
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.seen = :seen')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('seen', false)
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return array
     */
    public function fetchAllCandidates()
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param string $q description
     * @return array
     */
    public function fetchFilteredCandidates($q)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.lastName LIKE :lastName')
            ->orWhere('u.firstName LIKE :firstName')
            ->orWhere('u.username LIKE :username')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('lastName', '%' . $q . '%')
            ->setParameter('firstName', '%' . $q . '%')
            ->setParameter('username', '%' . $q . '%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }
}
