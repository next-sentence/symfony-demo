<?php

namespace AppBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlockChoiceType extends AbstractType
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return EntityType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_block_choice';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'class' => $this->repository->getClassName(),
                'choice_label' => 'title',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('o')
                        ->where('o.page IS NULL');
                },
            ])
        ;
    }
}
