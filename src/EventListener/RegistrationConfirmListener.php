<?php
namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\FOSUserEvents;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class RegistrationConfirmListener implements EventSubscriberInterface
{
    private $router;

    /**
     * Constructor
     * @param UrlGeneratorInterface $router
     */
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
                FOSUserEvents::REGISTRATION_SUCCESS => [
                    ['onRegistrationSuccess', -10],
                ],
                FOSUserEvents::REGISTRATION_CONFIRM => [
                    ['onRegistrationConfirm', -10],
                ],
            );
    }

    /**
     * Registraton success
     * @param \FOS\UserBundle\Event\FormEvent $event
     *
     * @return void
     */
    public function onRegistrationSuccess(\FOS\UserBundle\Event\FormEvent $event)
    {
        $url = $this->router->generate('home');
        $session = $event->getRequest()->getSession();
        $session->getFlashBag()->add(
            'user_confirm_notice',
            'Un e-mail a été envoyé à l\'adresse ' . $event->getForm()['email']->getData() .
            " .Merci de consulter votre boite email pour valider votre création de compte chez LP"
        );
        $event->setResponse(new RedirectResponse($url));
    }

    /**
     * Registration confirm
     * @param \FOS\UserBundle\Event\GetResponseUserEvent $event
     *
     * @return void
     */
    public function onRegistrationConfirm(\FOS\UserBundle\Event\GetResponseUserEvent $event)
    {
        $url = $this->router->generate('user_profile');
        $session = $event->getRequest()->getSession();
        $session->getFlashBag()->add('user_confirm_notice', 'Content de vous voir sur LP!');
        $event->setResponse(new RedirectResponse($url));
    }
}
