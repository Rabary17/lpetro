<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    /**
     * @Route("/skill", name="skill")
     * @return          \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $skills = $em->getRepository('App:Skill')->fetchByUser($user->getId());

        return $this->render(
            'skill/index.html.twig', [
            'skills' => $skills,
            'user' => $user->getId(),
            ]
        );
    }

    /**
     * @Route("/skill/delete/{id}", name="delete_skill")
     * @param                       string $id
     * @return                      \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete($id)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $skill = $em->getRepository('App:Skill')->find($id);
        if ($skill) {
            $em->remove($skill);
            $em->flush();

            return $this->redirectToRoute('skill');
        }

        return $this->render(
            'skill/index.html.twig', [
            'skills' => $skill,
            'error' => 'Impossible de supprimé ce compétence',
            'user' => $user->getId(),
            ]
        );
    }
}
