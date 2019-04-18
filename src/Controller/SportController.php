<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SportController extends AbstractController
{
    /**
     * @Route("/sports", name="sport")
     * @return           Symfony\Component\HttpFoundation\JsonResponse  description
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $sports = $em->getRepository('App:Sport')->findAll();

        return $this->json($sports, 200, [], ['groups' => ['public']]);
    }
}
