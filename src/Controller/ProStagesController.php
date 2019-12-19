<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;


class ProStagesController extends AbstractController
{
    /** 
     * @Route("/", name="accueil")
    */
    public function PageAccueil()
    {
        
        return $this->render('pro_stages/index.html.twig',[]);
    }
 

    /** 
     * @Route("/stages/{id}", name="stages")
    */
    public function PageStages($id)
    {
        // Récupérer le repository de l'entité Stage
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        // Récupérer les stages enregistrés en BD
        $stage = $repositoryStage->find($id);

        return $this->render('pro_stages/stage.html.twig', ['stage'=> $stage]);

        
    }

    /** 
     * @Route("/listestages/", name="listeStages")
    */
    public function PageListeStages()
    {
         // Récupérer le repository de l'entité Stage
         $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

         // Récupérer les stages enregistrés en BD
         $stages = $repositoryStage->findAll();
 
         // Envoyer les stages récupérés à la vue chargée de les afficher
        return $this->render('pro_stages/ListeStages.html.twig',['stages' => $stages]);

    }

    /** 
     * @Route("/listeEntreprises/", name="listeEntreprises")
    */
    public function PageListeEntreprises()
    {
         // Récupérer le repository de l'entité Entreprise
         $repositoryEntreprises = $this->getDoctrine()->getRepository(Entreprise::class);

         // Récupérer les entreprises enregistrés en BD
         $entreprises = $repositoryEntreprises->findAll();
 
         // Envoyer les entreprises récupérés à la vue chargée de les afficher
        return $this->render('pro_stages/ListeEntreprises.html.twig',['entreprises' => $entreprises]);

    }

    /** 
     * @Route("/listeFormations/", name="listeFormations")
    */
    public function PageListeFormations()
    {
         // Récupérer le repository de l'entité formation
         $repositoryFormations = $this->getDoctrine()->getRepository(Formation::class);

         // Récupérer les stformations enregistrés en BD
         $formations = $repositoryFormations->findAll();
 
         // Envoyer les formations récupérés à la vue chargée de les afficher
        return $this->render('pro_stages/ListeFormations.html.twig',['formations' => $formations]);

    }


}

?>