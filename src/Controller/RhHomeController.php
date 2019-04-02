<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RhHomeController extends AbstractController
{
    /**
     * @Route("/rh/home", name="rh_home")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $candidates = $em->getRepository('App:User')->fetchAllRecentCandidates();

        return $this->render('rh_home/index.html.twig', [
            'candidates' => $candidates,
        ]);
    }

    /**
     * @Route("/rh/cvs", name="rh_view_cvs")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function listCvs()
    {
        $em = $this->getDoctrine()->getManager();
        $candidates = $em->getRepository('App:User')->fetchAllCandidates();

        return $this->render('rh_home/index.html.twig', [
            'candidates' => $candidates,
        ]);
    }
}
