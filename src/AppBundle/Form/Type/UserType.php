<?php

namespace AppBundle\Form\Type;

use Sylius\Bundle\UserBundle\Form\Type\UserType as BaseUserType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends BaseUserType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', TextType::class, [
                'label' => 'name',
            ])
            ->add('info', TextType::class, [
                'label' => 'info',
            ])
            ->add('title', TextType::class, [
                'label' => 'title',
            ])
            ->add('file', FileType::class, [
                'label' => 'avatar',
            ]);
    }

}