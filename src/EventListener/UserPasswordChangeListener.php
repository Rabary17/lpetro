<?php
namespace App\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class UserPasswordChangeListener implements EventSubscriberInterface
{
    private $router;

    /**
     * @param UrlGeneratorInterface $router
     */
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => [
                ['onChangePasswordSuccess', +10000],
            ],
        ];
    }

    /**
     * [onChangePasswordSuccess description]
     * @param  FormEvent $event [description]
     * @return [type]                      [description]
     */
    public function onChangePasswordSuccess(FormEvent $event)
    {
        $url = $this->router->generate('fos_user_security_logout');
        $session = $event->getRequest()->getSession();
        $session->getFlashBag()->add('user_confirm_notice', 'Votre mot de passe a bien été changé.!');
        $event->setResponse(new RedirectResponse($url));
    }
}
