<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\UserService;

class CandidatController extends AbstractController
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
     * @Route("/candidat/{id}", name="candidat_view")
     * @param string $id id candidat
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index($id)
    {
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository('App:User')->find($id);
        if ($candidat) {
        	$viewCandidat = $this->userService->cvViewed($id);
            return $this->render('candidat/index.html.twig', [
            	'candidat' => $viewCandidat
            ]);
        }

        return $this->redirectToRoute('rh_home');
    }
}
