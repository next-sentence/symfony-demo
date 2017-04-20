<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use FOS\RestBundle\View\View;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

class PageController extends ResourceController
{

    public function detailsAction(Request $request)
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        /** @var Page $page */
        $page = $this->findOr404($configuration);

        $view = View::create($page);

        $view
            ->setTemplate('@page_templates/'.$page->getTemplate())
            ->setTemplateVar($this->metadata->getName())
            ->setData([
                'configuration' => $configuration,
                'metadata' => $this->metadata,
                'resource' => $page,
                $this->metadata->getName() => $page,
            ])
        ;

        return $this->viewHandler->handle($configuration, $view);
    }
}