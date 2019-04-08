<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use App\Service\LpMailerService;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Entity\Interview;

class RhHomeController extends AbstractController
{
    private $userService;
    private $mailer;

    /**
     * User service
     *
     * @param UserService     $userService [description]
     * @param LpMailerService $mailer      mailer
     */
    public function __construct(UserService $userService, LpMailerService $mailer)
    {
        $this->userService = $userService;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/rh/home", name="rh_home")
     * @return            \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $candidates = $em->getRepository('App:User')->fetchAllRecentCandidates();

        return $this->render(
            'rh_home/index.html.twig',
            [
                'candidates' => $candidates,
            ]
        );
    }

    /**
     * @Route("/rh/cvs", name="rh_view_cvs")
     * @return           \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function listCvs()
    {
        $em = $this->getDoctrine()->getManager();
        $candidates = $em->getRepository('App:User')->fetchAllCandidates();

        return $this->render(
            'rh_home/index.html.twig',
            [
                'candidates' => $candidates,
            ]
        );
    }

    /**
     * @Route("/rh/validate/{id}", name="rh_validate_cv")
     * @param                      datatype $id
     * @return                     \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function rhValidate($id)
    {
        $candidat = $this->userService->cvRhValidate($id);
        if ($candidat) {
            $this->mailer->sendMail(
                htmlentities($candidat),
                'LP | CV validé',
                $this->renderView(
                    'emails/validated-cv-confirmation-email.html.twig',
                    ['user' => $candidat]
                ),
                'user_confirm_notice',
                'Mail pour confirmation de validation de cv envoyé.'
            );
        }

        return $this->redirectToRoute('rh_view_cvs');
    }

    /**
     * @Route("/rh/profile", name="rh_profile")
     * @return            \Symfony\Component\HttpFoundation\Response
     */
    public function profile()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if ($user) {
            return $this->render('rh/rh_profile.html.twig', ['user' => $user]);
        }

        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @Route("/rh/profile/edit/{id}", name="rh_profile_edit")
     * @param                       \Symfony\Component\HttpFoundation\Request $request
     * @param                       string                                    $id
     * @return                      \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $rh = $em->getRepository('App:User')->find($id);
        $form = $this->createForm(UserType::class, $rh);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush();
            }
        }

        return  $this->render(
            'rh/edit_rh_profile.html.twig',
            [
            'user' => $rh,
            'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/rh/actions", name="rh_actions")
     * @return            \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function rhActions()
    {
        $em = $this->getDoctrine()->getManager();

        $candidates = 'rh actions';
        $interview = $em->getRepository('App:Interview')->findAll();

        return $this->render(
            'rh/rh_actions.html.twig',
            [
                'candidates' => $candidates,
                'interview' => $interview,
            ]
        );
    }
}
