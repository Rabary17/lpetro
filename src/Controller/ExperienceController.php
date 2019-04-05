<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExperienceController extends AbstractController
{
    /**
     * @Route("/experience", name="experience")
     * @return               \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $experiences = $em->getRepository('App:Experience')->findAll();

        return $this->render(
            'experience/index.html.twig', [
            'experiences' => $experiences,
            'user' => $user->getId(),
            ]
        );
    }
}
