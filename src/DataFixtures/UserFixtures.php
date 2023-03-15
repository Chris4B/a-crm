<?php

namespace App\DataFixtures;

use App\Entity\Contacts;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.

        $contact = new Contacts();
        $contact->setEmail('admin@admin.fr')
            ->setLastname('admin')
            ->setAddress('1 rue de la route')
            ->setFirstName('admin')
            ->setNumber('+33741734286')
            ->setZipCode('67000')
            ->setCountry('france')
            ->setIdFirm($this->getReference(FirmFixtures::ACHIEVE_FIRM));

        $manager->persist($contact);

        $user = new Users();
        $user->setFirstname('admin')
            ->setLastname('admin')
            ->setEmail('admin@admin.fr')
            ->setPassword($this->hasher->hashPassword($user, 'Patate0!'))
            ->setNumber('+33741734286')
//            ->setImage()
            ->setRoles(['ROLE_ADMIN'])
            ->setIdContact($contact);

        $manager->persist($user);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            FirmFixtures::class,
        ];
    }

}