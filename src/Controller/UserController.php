<?php

namespace App\Controller;

use App\Service\DefaultService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Service\UserService;
use App\Service\LpMailerService;

class UserController extends AbstractController
{
    private $userService;
    private $mailer;

    /**
     * contructor
     * @param UserService     $userService
     * @param LpMailerService $mailer      mailer
     */
    public function __construct(UserService $userService, LpMailerService $mailer)
    {
        $this->userService = $userService;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/profile", name="user_profile")
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @Route("/encode-cv/{id}", name="user_cv_send")
     * @param datatype $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendCvs($id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if ($user) {
            $submission = $em->getRepository('App:User')->find($id);
            $submission->setSubmit(true);
            $em->flush();

            $this->mailer->sendMail(
                htmlentities($user),
                'LP | Confirmation CV reçu',
                $this->renderView(
                    'emails/submit-cv-confirmation-email.html.twig',
                    ['user' => $user]
                ),
                'user_confirm_notice',
                'Votre CV a été soumis à LP. Un mail vous a été envoyé pour confirmer sa réception par LP'
            );

            return $this->redirectToRoute('user_profile');
        }

        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @Route("/profile/edit/{id}", name="user_profile_edit")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string                                    $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $em->getRepository('App:User')->find($id);
        $form = $this->createForm(UserType::class, $user);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
            }
        }

        return  $this->render('user/edit_profile.html.twig', [
                    'user' => $user,
                    'form' => $form->createView(),
        ]);
    }
}
