<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HobbyController extends AbstractController
{
    /**
     * @Route("/hobbies", name="hobby")
     * @return         Symfony\Component\HttpFoundation\JsonResponse  description
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $hobbies = $em->getRepository('App:Hobby')->findAll();

        return $this->json($hobbies, 200, [], ['groups' => ['public']]);
    }
}
