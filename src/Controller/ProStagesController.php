<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formation;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EntrepriseType;


class ProStagesController extends AbstractController
{
    /** 
     * @Route("/", name="accueil")
    */
    public function PageAccueil()
    {
        
        // Récupérer le repository de l'entité Stage
         $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

         // Récupérer les stages enregistrés en BD
         $stages = $repositoryStage->findAll();
 
         // Envoyer les stages récupérés à la vue chargée de les afficher
        return $this->render('pro_stages/index.html.twig',['stages' => $stages]);
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


     /**
     * @Route("tri/{typeRecherche}/{id}", name="listeStages_tri")
     */
    public function listeStages_tri($typeRecherche,$id)
    {
        if ($typeRecherche == "formation") {
            // Récupérer le repository de l'entité Stage
            $repositoryFormation = $this->getDoctrine()->getRepository(Formation::class);
            // Récupérer les stages enregistrés en BD
            $stages = $repositoryFormation->find($id)->getStages();
        }
        elseif ($typeRecherche == "entreprise"){
            // Récupérer le repository de l'entité Entreprise
            $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);
            // Récupérer les stages enregistrés en BD
            $stages = $repositoryEntreprise->find($id)->getStages();
        }
        
        // Envoyer les données récupérées à la vue chargée de les afficher
        return $this->render('pro_stages/ListeStages.html.twig',['stages' => $stages]);
    }
    


    /**
     * @Route("entreprises/{nomEntreprise}", name="ProStages_Stages_Par_Nom_Entreprise")
     */
    public function stagesParNomEntreprise($nomEntreprise)
    {
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        // Récupérer les stages enregistrées en BD avec le nom de l'entreprise "nomEntreprise"
        $stages = $repositoryStage->findByNomEntreprise($nomEntreprise);

        // Envoyer les entreprises récupérées à la vue chargée de les afficher
        return $this->render('pro_stages/parEntreprise.html.twig',['stages' => $stages,
                                                                   'nomEntreprise' => $nomEntreprise]);
    }


    /**
     * @Route("formations/{nomFormation}", name="ProStages_Stages_Par_Nom_Formation")
     */
    public function stagesParNomFormation($nomFormation)
    {
       
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        // Récupérer les stages enregistrées en BD avec le nom de l'entreprise "nomFormation"
        $stages = $repositoryStage->findByNomFormation($nomFormation);
		
        // Envoyer les entreprises récupérées à la vue chargée de les afficher
        return $this->render('pro_stages/parFormation.html.twig',['stages' => $stages,
                                                           'nomFormation' => $nomFormation]);
    }


    /**
     * @Route("/creer-entreprise", name="nouvelle_entreprise")
     */
    public function new(Request $request)
    {
        $entreprise = new Entreprise();
       
        $form = $this->CreateForm(EntrepriseType::class,$entreprise);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entreprise);
            $entityManager->flush();

            return $this->redirectToRoute('accueil');
       }

        return $this->render('pro_stages/creationEntreprise.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modifier-entreprise/{id}", name="modifier_entreprise")
     */
    public function edit(Request $request, Entreprise $entreprise)
    {
        $form = $this->CreateForm(EntrepriseType::class,$entreprise);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entreprise);
            $entityManager->flush();

            return $this->redirectToRoute('accueil');
       }

        return $this->render('pro_stages/modifierEntreprise.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}

?>