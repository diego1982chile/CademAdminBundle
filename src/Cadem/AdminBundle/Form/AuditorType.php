<?php

namespace Cadem\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AuditorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('audid')
            // ->add('rolid')
            ->add('nombre')
			->add('codigo')
			->add('rol')
			->add('supervisor')
            ->add('activo')			            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cadem\AdminBundle\Entity\Auditor'
        ));
    }

    public function getName()
    {
        return 'cadem_adminbundle_auditortype';
    }
}
