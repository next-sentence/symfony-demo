<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Block;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BlockType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'title',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'type',
                'choices' => Block::getTypeLabels(),
            ])
            ->add('content', TextareaType::class, [
                'label' => 'content',
            ])
        ;
    }

}