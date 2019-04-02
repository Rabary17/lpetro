<?php

namespace App\Controller;

use App\Service\DefaultService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Service\UserService;
use Swift_Mailer;

class UserController extends AbstractController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sendCvs($id , \Swift_Mailer $mailer)
    {
        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if ($user) {
            $submission = $em->getRepository('App:User')->find($id);
            $submission->setSubmit(true);
            $em->flush();
            
            $message = (new \Swift_Message('Envoi de CV'))
                ->setFrom('r.herriniaina@gmail.com')
                ->setTo('philipperazakatsara@gmail.com')
                ->setBody($this->renderView('emails/submit-cv-confirmation-email.html.twig',['user' => $user]), 'text/html');

            $mailer->send($message);

            $this->addFlash('success_submit', 'Votre CV a été soumis à LP. Un mail vous a été envoyé pour confirmer sa réception par LP');
            return $this->render('user/profile.html.twig', [
                   'user' => $user
                   ]);
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @Route("/profile/edit/{id}", name="user_profile_edit")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param Request $request
     * @param string $request
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
                    'form' => $form->createView()
                ]);
    }
}
