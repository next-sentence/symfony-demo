<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [

            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new SbS\AdminLTEBundle\SbSAdminLTEBundle(),
            new Trsteel\CkeditorBundle\TrsteelCkeditorBundle(),

            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
            new winzou\Bundle\StateMachineBundle\winzouStateMachineBundle(),

            new Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),
            new Sylius\Bundle\MailerBundle\SyliusMailerBundle(),
            new Sylius\Bundle\UserBundle\SyliusUserBundle(),
            new Sylius\Bundle\GridBundle\SyliusGridBundle(),

            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),

            new AppBundle\AppBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
