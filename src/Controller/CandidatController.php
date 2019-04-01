<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CandidatController extends AbstractController
{
    /**
     * @Route("/candidat/{id}", name="candidat_view")
     * @param string $id id candidat
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index($id)
    {
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository('App:User')->find($id);
        
        if ($candidat) {
            return $this->render('candidat/index.html.twig', [
            	'candidat' => $candidat
            ]);
        }

        return $this->redirectToRoute('rh_home');
    }
}
