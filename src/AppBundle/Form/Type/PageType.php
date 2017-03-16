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
        $block = new Block();
        $block->setTitle('asd');
        $block->setType(Block::TEXT_TYPE);

        $builder
            ->add('title', TextType::class, [
                'label' => 'title',
            ])
            ->add('route', TextType::class, [
                'label' => 'route',
            ])
            ->add('metaKeywords', TextType::class, [
                'label' => 'metaKeywords',
            ])
            ->add('metaDescriptions', TextType::class, [
                'label' => 'metaDescriptions',
            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'metaTitle',
            ])
            ->add('blocks', CollectionType::class, [
                'label' => 'blocks',
                'allow_add' => true,
                'allow_delete' => true,
                'entry_type'   => ChoiceType::class,
                'entry_options'  => array(
                    'choices'  => array(
                        $block
                    ),
                ),
            ]);
    }

}