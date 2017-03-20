<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Page;
use Symfony\Component\EventDispatcher\GenericEvent;

class PageListener
{
    /**
     * @param GenericEvent $event
     */
    public function prePersist(GenericEvent $event)
    {
        /** @var Page $page */
        $page = $event->getSubject();

        foreach ($page->getBlocks() as $block) {
            $block->setPage($page);
        }
    }
}
