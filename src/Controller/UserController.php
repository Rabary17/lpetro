<?php

namespace App\Controller;

use App\Service\DefaultService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="user_profile")
     */
    public function index()
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
		$user = $this->getUser();
		if ($user) {
			return $this->render('user/profile.html.twig', ['user' => $user]);
		}
		return $this->redirectToRoute('fos_user_security_login');
    }
}