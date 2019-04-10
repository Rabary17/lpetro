<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Service\UserService;
use App\Form\TagType;
use App\Form\InterviewType;
use App\Form\UserEditType;
use App\Entity\Tag;
use App\Entity\Interview;

class CandidatController extends AbstractController
{
    private $userService;

    /**
     * User service
     *
     * @param UserService $userService [description]
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("/candidat/{id}", name="candidat_view")
     * @param                   string $id id candidat
     * @return                  \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index($id)
    {
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository('App:User')->find($id);
        if ($candidat) {
            $viewCandidat = $this->userService->cvViewed($id);

            return $this->render(
                'candidat/index.html.twig',
                [
                'candidat' => $viewCandidat,
                ]
            );
        }

        return $this->redirectToRoute('rh_home');
    }

    /**
     * @Route("/candidat/edit/{id}", name="candidat_edit")
     * @param                        Request $request description
     * @param                        string  $id      id candidat
     * @return                       \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository('App:User')->find($id);
        $form = $this->createForm(UserEditType::class, $candidat);

        if ($request->getMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $em->flush();
            }
        }

        return $this->render(
            'candidat/edit.html.twig',
            [
            'candidat' => $candidat,
            'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/candidat/filter/list/candidat", name="candidat_list")
     * @param  Request $request description
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function list(Request $request)
    {
        $q = $request->request->get('q');
        $em = $this->getDoctrine()->getManager();
        $candidates = $em->getRepository('App:User')->fetchFilteredCandidates($q);

        return $this->json($candidates);
    }

    /**
     * @Route("/candidat/filter/all", name="candidat_list")
     * @param  Request $request description
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function filter(Request $request)
    {
        $rhValidated = $request->request->get('rh_validated');
        $status = $request->request->get('status');
        $nationality = $request->request->get('nationality');
        $em = $this->getDoctrine()->getManager();

        $candidates = [];

        if (isset($rhValidated) && isset($status) && isset($nationality)) {
            $candidates = $em->getRepository('App:User')->fetchByStatusNationalityRhValidated($status, $nationality);
        } elseif (isset($status) && isset($nationality)) {
            $candidates = $em->getRepository('App:User')->fetchByStatusNationality($status, $nationality);
        } elseif (isset($rhValidated) && isset($status)) {
            $candidates = $em->getRepository('App:User')->fetchByStatusRhValidated($status);
        } elseif (isset($rhValidated) && isset($nationality)) {
            $candidates = $em->getRepository('App:User')->fetchByNationalityRhValidate($nationality);
        } elseif (isset($nationality)) {
            $candidates = $em->getRepository('App:User')->fetchByNationality($nationality);
        } elseif (isset($status)) {
            $candidates = $em->getRepository('App:User')->fetchByStatus($status);
        } elseif (isset($rhValidated)) {
            $candidates = $em->getRepository('App:User')->fetchByRhValidated();
        }

        return $this->json($candidates);
    }
}
