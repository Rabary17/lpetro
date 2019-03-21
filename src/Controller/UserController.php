<?php

namespace App\Controller;

use App\Service\DefaultService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;

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

    /**
     * @Route("/profile/edit/{id}", name="user_profile_edit")
     */
    public function edit(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    	$user = $em->getRepository('App:user')->find($id);
        $form = $this->createForm(UserType::class, $user);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $em->flush();
            }
        }

    	return  $this->render('user/edit_profile.html.twig', [
    				'user' => $user,
    				'form' => $form->createView()
    			]);
    }
}