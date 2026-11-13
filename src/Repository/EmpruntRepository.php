<?php

namespace App\Repository;

use App\Entity\Emprunt;
use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emprunt>
 */
class EmpruntRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emprunt::class);
    }

    public function findDerniersPourLivre(Livre $livre, int $nombre = 5): array
    {
        return $this->createQueryBuilder('e')
            ->join('e.adherent', 'a')
            ->addSelect('a')
            ->andWhere('e.livre = :livre')
            ->setParameter('livre', $livre)
            ->orderBy('e.dateEmprunt', 'DESC')
            ->setMaxResults($nombre)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Emprunt[] Returns an array of Emprunt objects
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

//    public function findOneBySomeField($value): ?Emprunt
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
