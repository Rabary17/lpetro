<?php

namespace App\Controller;

use App\Service\DefaultService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     * @param DefaultService $defaultservice
     * @return JsonResponse
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig');
    }
}
