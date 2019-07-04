<?php

namespace App\Repository;

use App\Entity\BBCounter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BBCounter|null find($id, $lockMode = null, $lockVersion = null)
 * @method BBCounter|null findOneBy(array $criteria, array $orderBy = null)
 * @method BBCounter[]    findAll()
 * @method BBCounter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BBCounterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BBCounter::class);
    }

    // /**
    //  * @return BBCounter[] Returns an array of BBCounter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BBCounter
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
