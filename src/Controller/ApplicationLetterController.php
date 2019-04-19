<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ApplicationLetterType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ApplicationLetter;
use App\Service\LpMailerService;

class ApplicationLetterController extends AbstractController
{

    private $mailer;

    /**
     * contructor
     *
     * @param UserService     $userService
     * @param LpMailerService $mailer      mailer
     */
    public function __construct(LpMailerService $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route("/application-letter/{jobid}", name="application_letter")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, $jobid)
    {
        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $application = new ApplicationLetter();
        $jobOpening = $em->getRepository('App:JobOpening')->find($jobid);
        $form = $this->createForm(ApplicationLetterType::class, $application);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $application->setUser($user);
                $application->setJobOpening($jobOpening);
                $em->persist($application);
                $em->flush();

                $this->mailer->sendMail(
                    htmlentities($user),
                    'LP | Candidature reçu',
                    $this->renderView(
                        'emails/received-application-letter-confirmation-email.html.twig',
                        [
                            'user' => $user,
                            'jobOpening' => $jobOpening
                        ]
                    ),
                    'user_confirm_notice',
                    'Votre candidature a été envoyé à LP. Un mail vous a été envoyé pour confirmer sa réception par LP'
                );

                return $this->redirectToRoute('job_opening');
            }
        }

        return $this->render(
            'application_letter/index.html.twig',
            [
                'user' => $user,
                'jobOpening' => $jobOpening,
                'form' => $form->createView(),
            ]
        );
    }
}
