<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ApplicationLetterType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\ApplicationLetter;

class ApplicationLetterController extends AbstractController
{
    /**
     * @Route("/application-letter", name="application_letter")
     * @param                        Request $request
     * @return                       \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $application = new ApplicationLetter();
        $form = $this->createForm(ApplicationLetterType::class, $application);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $application->setUser($user);
                $em->persist($application);
                $em->flush();

                return $this->redirectToRoute('application_letter');
            }
        }

        return $this->render(
            'application_letter/index.html.twig',
            [
                'user' => $user,
                'form' => $form->createView(),
            ]
        );
    }
}
