<?php

namespace Cadem\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudiosalaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('estudioid')
            // ->add('salaid')
			->add('estudio')
            ->add('sala')
            ->add('activo');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cadem\AdminBundle\Entity\Estudiosala'
        ));
    }

    public function getName()
    {
        return 'cadem_adminbundle_estudiosalatype';
    }
}
