<?php
namespace App\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Event\GetResponseUserEvent;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class PasswordResettingListener implements EventSubscriberInterface {
    private $router;

    public function __construct(UrlGeneratorInterface $router) {
        $this->router = $router;
    }

    public static function getSubscribedEvents() {
        return array(
            FOSUserEvents::RESETTING_RESET_SUCCESS => [
                ['onPasswordResettingSuccess', -10]
            ],
            FOSUserEvents::RESETTING_RESET_REQUEST => [
                ['onResettingResetRequest', -10]
            ],
        );
    }

    public function onPasswordResettingSuccess(FormEvent $event) {
        $url = $this->router->generate('user_profile');
        $session = $event->getRequest()->getSession();
        $session->getFlashBag()->add('user_confirm_notice', 'Votre mot de passe a bien été réinitialisé.');
        $event->setResponse(new RedirectResponse($url));
    }
    public function onResettingResetRequest(GetResponseUserEvent $event) {
        $url = $this->router->generate('home');
        $session = $event->getRequest()->getSession();
        $session->getFlashBag()->add('user_confirm_notice', "Un e-mail a été envoyé à votre adresse email. Merci de consulter votre boite email pour pouvoir réinitialiser votre mot de passe");
        $event->setResponse(new RedirectResponse($url));
    }
}