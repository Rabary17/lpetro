<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\UserService;
use App\Form\AdminEditType;

class AdminController extends BaseAdminController
{
    private $passwordEncoder;
    private $userService;

    /**
     * [__construct description]
     * @param UserPasswordEncoderInterface $passwordEncoder [description]
     * @param UserService                  $userService     description
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserService $userService)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userService = $userService;
    }

    /**
     * [persistEntity description]
     * @param string $entity [description]
     * @return void [description]
     */
    public function persistEntity($entity)
    {
        $this->encodePassword($entity);
        parent::persistEntity($entity);
    }

    /**
     * [updateEntity description]
     * @param string $entity [description]
     * @return void         [description]
     */
    public function updateEntity($entity)
    {
        $this->encodePassword($entity);
        parent::updateEntity($entity);
    }

    /**
     * [encodePassword description]
     * @param  User $user [description]
     * @return void       [description]
     */
    public function encodePassword($user)
    {
        if (!$user instanceof User) {
            return;
        }

        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $user->getPassword())
        );
    }

    /**
     * @param Request $request description
     * @Route(path = "/admin/cv/show", name = "show_cv")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showCv(Request $request)
    {
        $id = $request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository('App:User')->find($id);
        if ($candidat) {
            $viewCandidat = $this->userService->cvViewed($id);

            return $this->render(
                'admin/cv.html.twig',
                [
                    'candidat' => $viewCandidat,
                ]
            );
        }

        return $this->redirectToRoute('easyadmin');
    }

    /**
     * @Route("/archived/{id}", name="admin_archived_cv")
     * @param                      datatype $id
     * @return                     \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function cvArchived($id)
    {
        $this->userService->cvArchived($id);

        return $this->redirectToRoute('easyadmin', array('entity' => 'Cv', 'action' => 'list'));
    }

    /**
     * @Route("/profile/edit", name="admin_edit_profile")
     * @param Request $request description
     * @return                     \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editProfile(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(AdminEditType::class, $user);

        if ($request->getMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $em->flush();
            }
        }

        return $this->render(
            'admin/edit_profile.html.twig',
            [
                'user' => $user,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/profile", name="admin_profile")
     * @return                     \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showProfile()
    {
        $user = $this->getUser();

        return $this->render(
            'admin/show_profile.html.twig',
            [
                'user' => $user,
            ]
        );
    }
}
