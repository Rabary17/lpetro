<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Mailer\Mailer;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Exception;

class RegistrationController extends BaseController
{
    private $formFactory;
    private $dispatcher;
    private $userManager;
    private $mailer;

    /**
     * [__construct description]
     * @param FactoryInterface         $formFactory [description]
     * @param EventDispatcherInterface $dispatcher  [description]
     * @param UserManagerInterface     $userManager [description]
     * @param Mailer                   $mailer      [description]
     */
    public function __construct(FactoryInterface $formFactory, EventDispatcherInterface $dispatcher, UserManagerInterface $userManager, Mailer $mailer)
    {
        $this->formFactory = $formFactory;
        $this->dispatcher = $dispatcher;
        $this->userManager = $userManager;
        $this->mailer = $mailer;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function registerAction(Request $request)
    {
        $user = $this->userManager->createUser();
        $user->setEnabled(true);
        $event = new GetResponseUserEvent($user, $request);
        $this->dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);
        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }
        $form = $this->formFactory->createForm(array('csrf_protection' => false, 'allow_extra_fields'=> true));
        $form->setData($user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid() && $this->captchaverify($request->get('g-recaptcha-response'))) {
                $event = new FormEvent($form, $request);
                $this->dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $this->userManager->updateUser($user);
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }
                $this->dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
                return $response;
            } else {
                $this->addFlash(
                    'user_confirm_notice',
                    'Vous devez tester le reCAPTCHA'
                );
            }
            $event = new FormEvent($form, $request);
            $this->dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);
            if (null !== $response = $event->getResponse()) {
                return $response;
            }
        }
        return $this->render('bundles/FOSUserBundle/Registration/register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    function captchaverify($recaptcha)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        if ($ch === false) {
            throw new Exception('failed to initialize');
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret"=>"6LfBBXcUAAAAAJP7RCk6NYxgKlHz5PDJYfeBejkA",
            "response"=>$recaptcha)
        );
        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;        
    }
}
