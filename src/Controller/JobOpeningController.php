<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JobOpeningController extends AbstractController
{
    /**
     * @Route("/job/opening", name="job_opening")
	 * @return Symfony\Component\HttpFoundation\JsonResponse description
     */
    public function index()
    {
    	$em = $this->getDoctrine()->getManager();
    	$jobOpenings = $em->getRepository('App:JobOpening')->fetchAll();
        return $this->render('job_opening/index.html.twig', [
            'jobOpenings' => $jobOpenings,
        ]);
    }

    /**
     * @Route("/job/opening/{id}", name="job_opening_detail")
	 * @return Symfony\Component\HttpFoundation\JsonResponse description
     */
    public function viewDetail($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$jobOpening = $em->getRepository('App:JobOpening')->find($id);
        return $this->render('job_opening/detail.html.twig', [
            'jobOpening' => $jobOpening,
        ]);
    }
}
