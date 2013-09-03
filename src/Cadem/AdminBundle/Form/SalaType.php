<?php

namespace Cadem\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SalaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('foliocadem')
            ->add('calle')
            ->add('numerocalle')
            ->add('latitud')
            ->add('longitud')
            ->add('respuestaGmap')
            ->add('tipoGmap')
            ->add('activo')
            ->add('comuna')
            ->add('formato')
            ->add('cadena')
            ->add('canal')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cadem\AdminBundle\Entity\Sala'
        ));
    }

    public function getName()
    {
        return 'cadem_adminbundle_salatype';
    }
}
