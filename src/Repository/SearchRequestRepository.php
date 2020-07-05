<?php

namespace App\Repository;

use App\Entity\SearchRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SearchRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method SearchRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method SearchRequest[]    findAll()
 * @method SearchRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SearchRequest::class);
    }

    public function findNumberOfSearchesForEachCity()
    {
        return $this->createQueryBuilder('s')
            ->select('s.city, count(s.city)')
            ->groupBy('s.city')
            ->orderBy('count(s.city)', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return SearchRequest[] Returns an array of SearchRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SearchRequest
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
