<?php

namespace App\Repository;

use App\Entity\MicroPost;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    private ?EntityManagerInterface $em =null;

    public function __construct(ManagerRegistry        $registry,
                                EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct($registry, Product::class);
    }

    public function getProductList(){

        $productList= $this->em->createQueryBuilder()->select('p')->from(Product::class, 'p')->orderBy("p.id", 'DESC')->getQuery()->getResult();

        return $productList;
    }
}