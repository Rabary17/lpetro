<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    /**
     * @Route("/training", name="training")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
 		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    	$em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $trainings = $em->getRepository('App:Training')->fetchByUser($user->getId());
        return $this->render('training/index.html.twig', [
            'trainings' => $trainings,
            'user' => $user->getId()
        ]);
    }

    /**
     * @Route("/training/delete/{id}", name="delete_training")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $training = $em->getRepository('App:Training')->find($id);
        if ($training) {
            $em->remove($training);
            $em->flush();
        }

        return $this->redirectToRoute('training');
    }
}
