<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Block;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PageType extends AbstractResourceType
{
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
            ->add('blocks', BlockChoiceType::class, [
                'label' => 'app.form.page.blocks',
                'multiple' => true,
            ]);
    }

}