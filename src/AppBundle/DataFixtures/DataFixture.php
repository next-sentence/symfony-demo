<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Intl\Intl;

/**
 * Base data fixture.
 */
abstract class DataFixture extends AbstractFixture implements ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * Container.
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Default locale.
     *
     * @var string
     */
    protected $defaultLocale;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function __call($method, $arguments)
    {
        $matches = [];
        if (preg_match('/^get(.*)Repository$/', $method, $matches)) {
            return $this->get('sylius.repository.'.$matches[1]);
        }
        if (preg_match('/^get(.*)Factory$/', $method, $matches)) {
            return $this->get('sylius.factory.'.$matches[1]);
        }

        return call_user_func_array([$this, $method], $arguments);
    }

    /**
     * Dispatch an event.
     *
     * @param string $name
     * @param object $object
     */
    protected function dispatchEvent($name, $object)
    {
        return $this->get('event_dispatcher')->dispatch($name, new GenericEvent($object));
    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function get($id)
    {
        return $this->container->get($id);
    }
}
