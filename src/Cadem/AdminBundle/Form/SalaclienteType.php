<?php

namespace Cadem\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SalaclienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clienteid')
            ->add('codigosala')
            ->add('activo')
            ->add('cliente')
            ->add('empleado')
            ->add('sala')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cadem\AdminBundle\Entity\Salacliente'
        ));
    }

    public function getName()
    {
        return 'cadem_adminbundle_salaclientetype';
    }
}
