<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\formation;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $formation_DUTInfo = new formation();
        $formation_DUTInfo->setNom("DUT Informatique");
        $manager->persist($formation_DUTInfo);

        $formation_DU_TIC = new formation();
        $formation_DU_TIC->setNom("DU Technologies de l'Information et de la Communication");
        $manager->persist($formation_DU_TIC);

        $formation_License = new formation();
        $formation_License->setNom("License Professionnelle");
        $manager->persist($formation_License);

        $manager->flush();
    }
}
