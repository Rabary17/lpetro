<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class TagController extends AbstractController
{
    /**
     * @Route("/tags", name="tag")
     * @return Symfony\Component\HttpFoundation\JsonResponse  description
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('App:Tag')->findAll();

        return $this->json($tags, 200, [], ['groups' => ['public']]);
    }
}
