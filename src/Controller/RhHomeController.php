<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
use App\Service\LpMailerService;

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
}
