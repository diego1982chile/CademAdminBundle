<?php

namespace Cadem\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('codigo')            
            ->add('fabricante')
            ->add('marca')
			->add('activo')
            // ->add('tipocodigo')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cadem\AdminBundle\Entity\Item'
        ));
    }

    public function getName()
    {
        return 'cadem_adminbundle_itemtype';
    }
}
