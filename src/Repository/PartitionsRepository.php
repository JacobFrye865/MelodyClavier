<?php

namespace App\Repository;

use App\Entity\Partitions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Partitions>
 *
 * @method Partitions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partitions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partitions[]    findAll()
 * @method Partitions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartitionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partitions::class);
    }

//    /**
//     * @return Partitions[] Returns an array of Partitions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Partitions
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
