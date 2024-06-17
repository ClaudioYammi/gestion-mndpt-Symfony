<?php

namespace App\Repository;

use App\Entity\Detentionvoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Detentionvoiture>
 *
 * @method Detentionvoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detentionvoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detentionvoiture[]    findAll()
 * @method Detentionvoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetentionvoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detentionvoiture::class);
    }

    //    /**
    //     * @return Detentionvoiture[] Returns an array of Detentionvoiture objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Detentionvoiture
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
