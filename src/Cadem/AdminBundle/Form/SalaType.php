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
			->add('cadena')
            ->add('canal')
            ->add('calle')
            ->add('numerocalle')
			->add('comuna')
            ->add('latitud')
            ->add('longitud')            
            ->add('activo')            
            // ->add('formato')            
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
