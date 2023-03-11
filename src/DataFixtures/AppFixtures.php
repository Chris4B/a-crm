<?php

namespace App\DataFixtures;

use App\Entity\Contacts;
use App\Entity\Firms;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;


    public function __construct(){
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for($i=1; $i<=50; $i++){
            $contact = new Contacts();
            $contact->setEmail('contact'.$i.'@test.fr')
                ->setLastname($this->faker->word())
                ->setAddress($this->faker->address())
                ->setFirstName('contact'.$i)
                ->setPhoneNumber($this->faker->e164PhoneNumber())
                ->setZipCode('6700'.$i)
                ->setCountry('france');
            $manager->persist($contact);

            $user = new Users();
            $user->setFirstname($this->faker->word())
                ->setLastname($this->faker->word())
                ->setEmail($this->faker->email())
                ->setPassword($this->faker->password())
                ->setNumber($this->faker->e164PhoneNumber())
                ->setImage($this->faker->word());
            $manager->persist($user);

            $firm = new Firms($this->faker->word());
            $firm->setFirmName($this->faker->word())
                ->setEmail('entreprise'.$i.'@test.fr')
                ->setPhoneNumber($this->faker->e164PhoneNumber())
                ->setAddress($this->faker->address())
                ->setSiret('234567Q8'.$i)
                ->setZipCode('6700'.$i);
            $manager->persist($firm);

        }

        $manager->flush();



    }
}
