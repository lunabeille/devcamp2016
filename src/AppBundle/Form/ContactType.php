<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as SFType;

use AppBundle\Entity\Contact;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('email', 'email', array(
            //     'attr' => array(
            //         'placeholder' => 'votre email',
            //     )
            // ))
            ->add('subject', SFType\TextType::class, [
                    'attr' => [
                        'placeholder' => 'Sujet',
                    ]
                ])
            ->add('content', SFType\TextareaType::class)
            ->add('save', SFType\SubmitType::class, [
                'label' => 'Envoyer',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }
}