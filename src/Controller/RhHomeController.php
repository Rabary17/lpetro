<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;

class RhHomeController extends AbstractController
{

    private $userService;

    /**
     * User service
     * @param UserService $userService [description]
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

    /**
     * @Route("/rh/validate/{id}", name="rh_validate_cv")
     * @param datatype $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function rhValidate($id)
    {   
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository('App:User')->find($id);
        $this->userService->cvRhValidate($id);
        return $this->redirectToRoute('rh_view_cvs');
    }
}
