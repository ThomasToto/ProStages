<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un générateur de données 
        $faker = \Faker\Factory::create('fr_FR');


        // Création de la formation DUT Informatique
        
        
        $nbEntreprises = $faker->numberBetween($min = 1,$max = 10);
        $tableauEntreprises = array();
        for ($i=1; $i <= $nbEntreprises; $i++) { 
            $uneEntreprise = new Entreprise();
            $uneEntreprise->setNom($faker->Company);
            $uneEntreprise->setActivite($faker->catchPhrase);
            $uneEntreprise->setAdresse($faker->address);
            $uneEntreprise->setSiteweb($faker->url);
            array_push($tableauEntreprises,$uneEntreprise);
        }
        foreach ($tableauEntreprises as $entreprise) {
            $manager->persist($entreprise);
        }

        $tableauFormations = array("DUT Informatique","Licence Pro Multimédia","DU Technologie de l'Information");
        foreach ($tableauFormations as $formation) {
            $uneFormation = new Formation();
            $uneFormation->setNom($formation);
            $manager->persist($uneFormation);
            /********************
            ******* STAGES ******
            *********************/
            $nbStages = $faker->numberBetween($min = 3,$max = 10);
            for ($i=1; $i < $nbStages; $i++) { 
                $stage = new Stage();
                $stage->setTitre($faker->jobTitle);
                $stage->setDescription($faker->realText($maxNbChars = 200, $indexSize = 2));
                $stage->setEmail($faker->email);
                $stage->addFormation($uneFormation);
                $numEntreprise = $faker->numberBetween($min = 0, $max = $nbEntreprises - 1);
                $stage->setEntreprises($tableauEntreprises[$numEntreprise]);
                $tableauEntreprises[$numEntreprise]->addStage($stage);
                $manager->persist($stage);
                $manager->persist($tableauEntreprises[$numEntreprise]);
            }
        }


  
        $manager->flush();
    }
}
