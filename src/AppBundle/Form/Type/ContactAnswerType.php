<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Class ContactType.
 *
 * @category FormType
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
                'description',
                TextareaType::class,
                array(
                    'label' => 'backend.admin.answer',
                    'required' => true,
                    'attr' => array(
                        'rows' => 6,
                    ),
                )
            )
            ->add(
                'send',
                SubmitType::class,
                array(
                    'attr' => array(
                        'class' => 'btn-primary',
                        'label' => 'backend.admin.send',
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
