<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserSkillController extends AbstractController
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
        $skills = $em->getRepository('App:UserSkill')->fetchByUser($user->getId());

        return $this->render(
            'user_skill/index.html.twig',
            [
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
        $skill = $em->getRepository('App:UserSkill')->find($id);
        if ($skill) {
            $em->remove($skill);
            $em->flush();

            return $this->redirectToRoute('skill');
        }

        return $this->render(
            'user_skill/index.html.twig',
            [
            'skills' => $skill,
            'error' => 'Impossible de supprimé ce compétence',
            'user' => $user->getId(),
            ]
        );
    }
}
