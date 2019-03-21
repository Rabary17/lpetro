<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    /**
     * @Route("/training", name="training")
     */
    public function index()
    {
 		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    	$em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $trainings = $em->getRepository('App:Training')->fetchByUser($user->getId());
        return $this->render('training/index.html.twig', [
            'trainings' => $trainings,
        ]);
    }
}
