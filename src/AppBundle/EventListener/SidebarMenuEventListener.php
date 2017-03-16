<?php

namespace AppBundle\EventListener;

use SbS\AdminLTEBundle\Event\SidebarMenuEvent;
use SbS\AdminLTEBundle\Model\MenuItemModel;
use SbS\AdminLTEBundle\Model\MenuItemInterface;

class SidebarMenuEventListener
{
    /**
     * @param SidebarMenuEvent $event
     */
    public function onShowMenu(SidebarMenuEvent $event)
    {
        foreach ($this->getMenu() as $item) {
            $event->addItem($item);
        }
    }

    /**
     * @return array
     */
    protected function getMenu()
    {
        $labelAdmin = new MenuItemModel('Administration');
        $labelUsers = (new MenuItemModel('Users'))->setRoute('sylius_backend_backend_user_index');

        $labelContent = new MenuItemModel('Content');

        $itemPages = (new MenuItemModel('Pages'))
            ->setRoute('app_backend_page_index')
            ->setIcon('fa fa-circle-o')
        ;

        $itemBlocks = (new MenuItemModel('Blocks'))
            ->setRoute('app_backend_block_index')
            ->setIcon('fa fa-circle-o')
        ;

        return [
            $labelAdmin,
            $labelUsers,
            $labelContent,
            $itemPages,
            $itemBlocks,
        ];
    }
}
