<?php

namespace AppBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PageType extends AbstractResourceType
{
    /**
     * @var FilesystemLoader
     */
    private $loader;

    /**
     * PageType constructor.
     * @param string $dataClass
     * @param array $validationGroups
     * @param \Twig_LoaderInterface $loader
     */
    public function __construct($dataClass, $validationGroups = [], \Twig_LoaderInterface $loader)
    {
        parent::__construct($dataClass, $validationGroups);

        $this->loader = $loader;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'app.form.page.title',
                'required' => true
            ])
            ->add('permalink', TextType::class, [
                'label' => 'app.form.page.permalink',
            ])
            ->add('metaKeywords', TextType::class, [
                'label' => 'app.form.page.meta_keywords',
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'app.form.page.meta_description',
            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'app.form.page.meta_title',
            ])
            ->add('template', ChoiceType::class, [
                'label' => 'app.form.page.template',
                'choices' => $this->findTemplatesInFolder(current($this->loader->getPaths('page_templates'))),
            ])
            ->add('blocks', BlockChoiceType::class, [
                'label' => 'app.form.page.blocks',
                'multiple' => true,
                'page' => !is_null($options['data']->getId()) ? $options['data'] : null,
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                if (null === $event->getData()) {
                    return;
                }
                $event->getForm()->add('parent', PageChoiceType::class, [
                    'label' => 'app.form.page.parent',
                    'required' => false,
                ]);
            })
        ;
    }

    /**
     * @return array
     */
    private function findTemplatesInFolder($dir)
    {
        $templates = array();

        if (is_dir($dir)) {
            $finder = new Finder();
            foreach ($finder->files()->followLinks()->in($dir) as $file) {
                $template = $file->getRelativePathname();
                if (false !== $template) {
                    $templates[strtok($template, '.')] = $template;
                }
            }
        }

        return $templates;
    }

}