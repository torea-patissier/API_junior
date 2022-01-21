<?php
// namespace App\DataFixtures;

// use App\Entity\User;
// use Doctrine\Bundle\FixturesBundle\Fixture;
// use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
// use Doctrine\Persistence\ObjectManager;
// use Faker\Factory;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// class AppFixtures extends Fixture
// {
//     private $manager;
//     private $faker;
//     private $hasher;

//     public function __construct(UserPasswordHasherInterface $hasher)
//     {
//         // $this->hasher = $hasher;
//         $this->faker=Factory::create("fr_FR");
//         $this->hasher = $hasher;
//     }

//     // ...
//     public function load(ObjectManager $manager)
//     {
//         $this->manager = $manager;  
//         $this->loadUser();
//         $manager->flush();
//     }

//     public function loadUser()
//     {
//         $city_id = [1,2,3];
//         $diploma_id = [1,3,4];
//         $profession_id = [1,3,4];

//         for ($i = 0; $i < 20; $i++){
//             $user = new User();
//             $user   ->setFirstname($this->faker->firstName())
//                     ->setLastname($this->faker->lastName())
//                     ->setEmail($this->faker->email())
//                     ->setDescription($this->faker->shuffle())
//                     ->setAvatar($this->faker->randomLetter())
//                     ->setYearOfExperience($this->faker->randomDigit())
//                     ->setCity($this->faker->randomElement($city_id))
//                     ->setDiploma($this->faker->randomElement($diploma_id))
//                     ->setProfession($this->faker->randomElement($profession_id))
//                     ->setTelephone($this->faker->phoneNumber())
//                     ->setPassword($this->hasher->hashPassword($user,$this->faker->password()));
                    
//             $this->manager->persist($user);
//         }
//     }
// }
?>