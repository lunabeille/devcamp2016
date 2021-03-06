<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as SFType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MemberCreateType extends MemberType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('username', SFType\TextType::class)
            ->add('avatar', SFType\FileType::class, [
                'label' => 'Photo de profil'
                ])
            ->add('email', SFType\EmailType::class)
            ->add('plainPassword', SFType\PasswordType::class, [
                'label' => 'Password',
                ])
            ->add('save', SFType\SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Member',
        ));
    }
}
