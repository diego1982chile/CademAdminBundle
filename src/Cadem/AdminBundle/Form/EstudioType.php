<?php

namespace Cadem\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('id')
            // ->add('clienteid')
            ->add('nombre')
            ->add('fechainicio')
            ->add('fechafin')
            ->add('activo')
            ->add('cliente')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cadem\AdminBundle\Entity\Estudio'
        ));
    }

    public function getName()
    {
        return 'cadem_adminbundle_estudiotype';
    }
}
