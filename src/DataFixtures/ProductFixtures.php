<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 40; $i++){
            $product = new Products();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10,1000));
            if ($i % 3 === 0) $product->setDescription('Product description for product '.$i);
            $product->setActive(true);
            $manager->persist($product);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
