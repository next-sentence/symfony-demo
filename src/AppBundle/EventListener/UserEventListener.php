<?php

namespace AppBundle\EventListener;

use SbS\AdminLTEBundle\Event\UserEvent;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserEventListener
{
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param UserEvent $event
     */
    public function onShowUser(UserEvent $event)
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $event->setUser($user);
    }
}
