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
                'label' => 'title',
                'required' => true
            ])
            ->add('permalink', TextType::class, [
                'label' => 'permalink',
            ])
            ->add('metaKeywords', TextType::class, [
                'label' => 'metaKeywords',
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'metaDescription',
            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'metaTitle',
            ])
            ->add('blocks', BlockChoiceType::class, [
                'label' => 'blocks',
                'multiple' => true,
            ]);
    }

}