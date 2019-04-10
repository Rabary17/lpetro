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
     * @param integer $statut      description
     * @param integer $nationality description
     * @return array
     */
    public function fetchByStatusNationalityRhValidated($statut, $nationality)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.statut = :statut')
            ->andWhere('u.nationality = :nationality')
            ->andWhere('u.rhvalidate = :rhvalidate')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('statut', $statut)
            ->setParameter('nationality', $nationality)
            ->setParameter('rhvalidate', true)
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer $statut description
     * @return array
     */
    public function fetchByStatusRhValidated($statut)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.statut = :statut')
            ->andWhere('u.rhvalidate = :rhvalidate')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('statut', $statut)
            ->setParameter('rhvalidate', true)
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer $statut      description
     * @param integer $nationality description
     * @return array
     */
    public function fetchByStatusNationality($statut, $nationality)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.statut = :statut')
            ->andWhere('u.nationality = :nationality')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('statut', $statut)
            ->setParameter('nationality', $nationality)
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer $statut description
     * @return array
     */
    public function fetchByStatus($statut)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.statut = :statut')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('statut', $statut)
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer $nationality description
     * @return array
     */
    public function fetchByNationalityRhValidate($nationality)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.nationality = :nationality')
            ->andWhere('u.rhvalidate = :rhvalidate')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('nationality', $nationality)
            ->setParameter('rhvalidate', true)
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer $nationality description
     * @return array
     */
    public function fetchByNationality($nationality)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.nationality = :nationality')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('nationality', $nationality)
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return array
     */
    public function fetchByRhValidated()
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.rhvalidate = :rhvalidate')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('rhvalidate', true)
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
