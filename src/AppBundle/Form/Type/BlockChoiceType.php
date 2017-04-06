<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Page;
use Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
        $queryBuilder = function (Options $options) {

            return function (EntityRepository $er) use ($options) {
                return $er->createQueryBuilder('o')
                    ->where('o.page IS NULL')
                    ->orWhere('o.page = :page')
                    ->setParameter('page', $options['page']);
            };
        };

        $resolver
            ->setDefaults([
                'class' => $this->repository->getClassName(),
                'choice_label' => 'title',
                'page' => null,
                'query_builder' =>$queryBuilder,
            ])
            ->setAllowedTypes('page', ['null', Page::class])
        ;
    }
}
