<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Block;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Trsteel\CkeditorBundle\Form\Type\CkeditorType;

class BlockType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'app.form.block.title',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'app.form.block.type',
                'choices' => Block::getTypeLabels(),
            ])
            ->add('content', CkeditorType::class, [
                'label' => 'app.form.block.content',
                'transformers' => ['html_purifier'],
            ])
        ;
    }

}