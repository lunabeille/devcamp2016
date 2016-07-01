<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as SFType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', SFType\TextType::class)
            ->add('content', SFType\TextareaType::class, [
                'attr' => array('class' => 'tinymce'),
                ])
            ->add('tags', SFType\ChoiceType::class, [
                'choices' => [
                    'A la Une' => 'homepage',
                    'Politique' => 'politics',
                    'Economie' => 'economy',
                    'International' => 'international',
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('created', SFType\DateTimeType::class)
            ->add('updated', SFType\DateTimeType::class)
            ->add('author', EntityType::class, [
                'class' => 'AppBundle\Entity\Member',
                'choice_label' => 'username',
                'query_builder' => null,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\News',
        ));
    }
}
