<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Juniors;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private $manager;
    private $faker;

    public function __construct(){

        $this->faker=Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager){
        
        $this->manager = $manager;
        $this->loadAdherent();
        $manager->flush();
    }

    /**
     * Création faker user
     */
    public function loadAdherent(){

        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Juniors();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $manager->persist($product);
        }        

    }
}
