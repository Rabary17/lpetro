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
     * @param integer[] $tags description
     * @return array
     */
    public function fetchByTags($tags)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->join('u.tags', 't')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('t.id IN (:tagids)')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->setParameter('tagids', $tags)
            ->distinct()
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer   $nationality description
     * @param integer[] $tags        description
     * @return array
     */
    public function fetchByNationalityTags($nationality, $tags)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->join('u.tags', 't')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.nationality = :nationality')
            ->andWhere('t.id IN (:tagid)')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->setParameter('tagid', $tags)
            ->setParameter('nationality', $nationality)
            ->distinct()
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer   $status description
     * @param integer[] $tags   description
     * @return array
     */
    public function fetchByStatusTags($status, $tags)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->join('u.tags', 't')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.statut = :status')
            ->andWhere('t.id IN (:tagid)')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->setParameter('tagid', $tags)
            ->setParameter('status', $status)
            ->distinct()
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer   $status description
     * @param integer[] $tags   description
     * @return array
     */
    public function fetchByRhValidateStatusTags($status, $tags)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->join('u.tags', 't')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.statut = :status')
            ->andWhere('u.rhvalidate = :rhvalidate')
            ->andWhere('t.id IN (:tagid)')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->setParameter('tagid', $tags)
            ->setParameter('status', $status)
            ->setParameter('rhvalidate', true)
            ->distinct()
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer   $nationality description
     * @param integer[] $tags        description
     * @return array
     */
    public function fetchByRhValidateNationalityTags($nationality, $tags)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->join('u.tags', 't')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.nationality = :nationality')
            ->andWhere('u.rhvalidate = :rhvalidate')
            ->andWhere('t.id IN (:tagid)')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->setParameter('tagid', $tags)
            ->setParameter('nationality', $nationality)
            ->setParameter('rhvalidate', true)
            ->distinct()
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer[] $tags description
     * @return array
     */
    public function fetchByRhValidateTags($tags)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->join('u.tags', 't')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.rhvalidate = :rhvalidate')
            ->andWhere('t.id IN (:tagid)')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->setParameter('tagid', $tags)
            ->setParameter('rhvalidate', true)
            ->distinct()
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param integer   $status      description
     * @param integer   $nationality description
     * @param integer[] $tags        description
     * @return array
     */
    public function fetchByRhValidateStatusNationalityTags($status, $nationality, $tags)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->join('u.tags', 't')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.rhvalidate = :rhvalidate')
            ->andWhere('u.statut = :status')
            ->andWhere('u.nationality = :nationality')
            ->andWhere('t.id IN (:tagids)')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->setParameter('tagids', $tags)
            ->setParameter('rhvalidate', true)
            ->setParameter('nationality', $nationality)
            ->setParameter('status', $status)
            ->distinct()
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
