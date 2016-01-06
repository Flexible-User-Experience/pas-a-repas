<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ContactType
 *
 * @category ContactAnswerType
 * @package  AppBundle\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class ContactAnswerType extends ContactType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                'text',
                array(
                    'label'    => 'frontend.index.contact.form.name',
                    'required' => false,
                    'read_only' => true,
                )
            )
            ->add(
                'email',
                'email',
                array(
                    'label'    => 'frontend.index.contact.form.email',
                    'required' => false,
                    'read_only' => true,
                )
            )
            ->add(
                'phone',
                'text',
                array(
                    'label'    => 'frontend.index.contact.form.phone',
                    'required' => false,
                    'read_only' => true,
                )
            )
            ->add(
                'message',
                'textarea',
                array(
                    'label'    => 'frontend.index.contact.form.message',
                    'required' => false,
                    'read_only' => true,
                    'attr'     => array(
                        'rows' => 6,
                    ),
                )
            )
            ->add(
                'description',
                'textarea',
                array(
                    'label'    => 'backend.admin.answer',
                    'required' => true,
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

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact_answer';
    }
}
