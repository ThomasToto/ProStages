<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function inscription(Request $request)
    {
        //Créer un utilisateur vide
        $utilisateur = new User();
       
        //Création du formulaire permettant de saisir un utilisateur
        $form = $this -> createForm(UserType::class,$utilisateur);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($stage);
            //$entityManager->flush();

            return $this->redirectToRoute('accueil');
       }

       //Affiche la page présentant le formulaire d'inscription
        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
