<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    /**
     * @Route("/skill", name="skill")
     */
    public function index()
    {
 		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    	$em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $skills = $em->getRepository('App:Skill')->fetchByUser($user->getId());
        return $this->render('skill/index.html.twig', [
            'skills' => $skills,
            'user' => $user->getId()
        ]);
    }
}
