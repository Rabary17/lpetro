<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JobOpeningController extends AbstractController
{
    /**
     * @Route("/job/opening", name="job_opening")
	 * @return Symfony\Component\HttpFoundation\JsonResponse  description
     */
    public function index()
    {
        return $this->render('job_opening/index.html.twig', [
            'controller_name' => 'JobOpeningController',
        ]);
    }
}
