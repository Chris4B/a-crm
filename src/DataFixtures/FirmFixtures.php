<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Firms;
use Doctrine\Persistence\ObjectManager;

class FirmFixtures extends Fixture
{
    const ACHIEVE_FIRM = "achieve";


    public function load(ObjectManager $manager):void

    {
        $firm = new Firms();
        $firm->setFirmName('Achieve')
            ->setEmail('contact@achieve.fr')
            ->setPhoneNumber('+33759064820')
            ->setAddress('1 rue de la route')
            ->setSiret('1537829273929')
            ->setZipCode('67000')
            ->setCountry('France');

        $manager->persist($firm);
        $manager->flush();


        $this->setReference(self::ACHIEVE_FIRM, $firm);


    }



}
