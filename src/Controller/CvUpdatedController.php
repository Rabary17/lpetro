<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CvUpdatedController extends AbstractController
{
    /**
     * @Route("/cvupdated/delete/{iduser}", name="cv_updated_delete")
     * @param                               string $iduser description
     * @return                              json description
     */
    public function deleteUpdatedCvViewed($iduser)
    {
        $em = $this->getDoctrine()->getManager();
        $cvUpdated = $em->getRepository('App:CvUpdated')->fetchByCandidat($iduser);

        foreach ($cvUpdated as $value) {
            $em->remove($value);
        }
        $em->flush();

        return $this->json(['success' => true]);
    }
}
