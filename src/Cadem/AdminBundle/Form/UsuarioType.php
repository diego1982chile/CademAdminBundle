<?php

namespace Cadem\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            // ->add('usernameCanonical')
            ->add('email')
            // ->add('emailCanonical')
            ->add('enabled')
            // ->add('salt')
            ->add('password')
			->add('createdAt')
			->add('updatedAt')
            // ->add('lastLogin')
            // ->add('locked')
            // ->add('expired')
            // ->add('expiresAt')
            // ->add('confirmationToken')
            // ->add('passwordRequestedAt')
            // ->add('roles')
            // ->add('credentialsExpired')
            // ->add('credentialsExpireAt')
            // ->add('rut')
            // ->add('clienteid')
            ->add('cliente')
            ->add('rol')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cadem\AdminBundle\Entity\Usuario'
        ));
    }

    public function getName()
    {
        return 'cadem_adminbundle_usuariotype';
    }
}
