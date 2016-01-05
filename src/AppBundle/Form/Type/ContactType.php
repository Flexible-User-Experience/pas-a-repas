<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ContactType
 *
 * @category FormType
 * @package  AppBundle\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class ContactType extends AbstractType
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

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact',
        ));
    }
}
