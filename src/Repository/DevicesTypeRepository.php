<?php

namespace App\Repository;

use App\Entity\DevicesType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DevicesType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevicesType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevicesType[]    findAll()
 * @method DevicesType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevicesTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DevicesType::class);
    }

//    /**
//     * @return DevicesType[] Returns an array of DevicesType objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DevicesType
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
