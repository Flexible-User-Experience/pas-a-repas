<?php

namespace AppBundle\Form\Type;

use AppBundle\Enum\ReceiptTypeEnum;
use AppBundle\Enum\YearEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class ReceiptType
 *
 * @category FormType
 * @package  AppBundle\Form\Type
 * @author   David Romaní <david@flux.cat>
 */
class ReceiptType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'type',
                ChoiceType::class,
                array(
                    'label' => 'backend.admin.type',
                    'required' => true,
                    'choices' => ReceiptTypeEnum::getEnumArray()
                )
            )
            ->add(
                'month',
                ChoiceType::class,
                array(
                    'label' => 'backend.admin.month',
                    'required' => true,
                    'choices' => array(
                        1 => 'Gener',
                        2 => 'Febrer',
                        3 => 'Març',
                        4 => 'Abril',
                        5 => 'Maig',
                        6 => 'Juny',
                        7 => 'Juliol',
                        8 => 'Agost',
                        9 => 'Setembre',
                        10 => 'Octubre',
                        11 => 'Novembre',
                        12 => 'Desembre',
                    ),
                    'choices_as_values' => false,
//                    'preferred_choices' => function() {
//
//                        return $choices = new \DateTime('now');
//                    }
                    'preferred_choices' => function($currentdate) {
                        if ($currentdate = time())

                        return $month = new \DateTime('now');
                    },
                )
            )
            ->add(
                'year',
                ChoiceType::class,
                array(
                    'label' => 'backend.admin.year',
                    'required' => true,
                    'choices' => YearEnum::getEnumArray()
                )
            )
            ->add(
                'send',
                SubmitType::class,
                array(
                    'label' => 'frontend.index.contact.form.submit',
                    'attr' => array(
                        'class' => 'btn-violet',
                    ),
                )
            );
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'receipt';
    }
}
