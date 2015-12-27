<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                array(
                    'label'    => 'frontend.index.contact.form.name',
                    'required' => true,
                )
            )
            ->add(
                'email',
                'email',
                array(
                    'label'    => 'frontend.index.contact.form.email',
                    'required' => true,
                )
            )
            ->add(
                'phone',
                'text',
                array(
                    'label'    => 'frontend.index.contact.form.phone',
                    'required' => false,
                )
            )
            ->add(
                'message',
                'textarea',
                array(
                    'label'    => 'frontend.index.contact.form.message',
                    'required' => false,
                    'attr'     => array(
                        'rows' => 6,
                    ),
                )
            )
            ->add(
                'send',
                'submit',
                array(
                    'label' => 'frontend.index.contact.form.submit',
                    'attr'  => array(
                        'class' => 'btn-violet',
                    ),
                )
            );
    }

    public function getName()
    {
        return 'contact';
    }
}
