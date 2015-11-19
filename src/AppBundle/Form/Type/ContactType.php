<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'NOM',
                'required' => true,
            ))
            ->add('email', 'email', array(
                'label' => 'EMAIL',
                'required' => true,
            ))
            ->add('phone', 'text', array(
                'label' => 'TELEFON',
                'required' => false,
            ))
            ->add('message', 'textarea', array(
                'label' => 'MISSATGE',
                'required' => false,
            ))
            ->add('send', 'submit', array(
                'label' => 'ENVIAR',
            ))
        ;
    }

    public function getName()
    {
        return 'contact';
    }
}
