<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProStagesController extends AbstractController
{
    /** 
     * @Route("/", name="accueil")
    */
    public function PageAccueil()
    {
        return $this->render('pro_stages/index.html.twig', [
            'message' => 'Bienvenue sur la page d accueil de ProStages',
        ]);
    }
 
    /** 
     * @Route("/entreprises", name="entreprises")
    */
    public function PageEntreprise()
    {
        return $this->render('pro_stages/index.html.twig', [
            'message' => 'Cette page affichera la liste des entreprises proposant un stage',
        ]);
    }

    /** 
     * @Route("/formations", name="formations")
    */
    public function PageFormation()
    {
        return $this->render('pro_stages/index.html.twig', [
            'message' => 'Cette page affichera la liste des formations de l IUT', 
        ]);
    }

    /** 
     * @Route("/stages/{id}", name="stages")
    */
    public function PageStages($id)
    {
        
        return $this->render('pro_stages/stage.html.twig', [
            'message' => 'Cette page affichera le descriptif du stage ayant pour identifiant : ', 'id' => $id,
        ]);

        
    }
}

?>