<?php

namespace App\Repository;

use App\Entity\Etatvoiture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Etatvoiture>
 *
 * @method Etatvoiture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etatvoiture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etatvoiture[]    findAll()
 * @method Etatvoiture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatvoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etatvoiture::class);
    }

    //    /**
    //     * @return Etatvoiture[] Returns an array of Etatvoiture objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Etatvoiture
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
