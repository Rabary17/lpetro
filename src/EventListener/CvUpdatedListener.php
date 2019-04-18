<?php
namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\CvUpdated;
use App\Entity\UserSkill;
use App\Entity\Training;
use App\Entity\Experience;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 * @HasLifecycleCallbacks
 */
class CvUpdatedListener implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            Events::postUpdate,
        ];
    }

    /**
     * @PostUpdate
     * @param  LifecycleEventArgs $args [description]
     * @return [type]                   [description]
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $cvUpdated = new CvUpdated();

        /**
         * 1 Training
         * 2 Experience
         * 3 Skill
         */
        if ($entity instanceof Training) {
            $cvUpdated->setSection(1);
            $trainingUpdated = $this->em->getRepository('App:CvUpdated')->findBySubSectionId($entity->getId());
            $cvUpdated->setSubSectionId($entity->getId());
            $cvUpdated->setUser($entity->getUser()->getId());
            if (!$trainingUpdated) {
                $this->em->persist($cvUpdated);
            }
        }

        if ($entity instanceof Experience) {
            $cvUpdated->setSection(2);
            $trainingUpdated = $this->em->getRepository('App:CvUpdated')->findBySubSectionId($entity->getId());
            $cvUpdated->setSubSectionId($entity->getId());
            $cvUpdated->setUser($entity->getUser()->getId());
            if (!$trainingUpdated) {
                $this->em->persist($cvUpdated);
            }
        }

        if ($entity instanceof UserSkill) {
            $cvUpdated->setSection(3);
            $trainingUpdated = $this->em->getRepository('App:CvUpdated')->findBySubSectionId($entity->getId());
            $cvUpdated->setSubSectionId($entity->getId());
            $cvUpdated->setUser($entity->getUser()->getId());
            if (!$trainingUpdated) {
                $this->em->persist($cvUpdated);
            }
        }

        $this->em->flush();
    }
}
