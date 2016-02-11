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
        $now = new \DateTime();
        $currentnumbermonth = $now->format('n');
        $currentyear = $now->format('Y');

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
                    'label'    => 'backend.admin.month',
                    'required' => true,
                    'choices'  => array(
                        'Gener'    => '1',
                        'Febrer'   => '2',
                        'Març'     => '3',
                        'Abril'    => '4',
                        'Maig'     => '5',
                        'Juny'     => '6',
                        'Juliol'   => '7',
                        'Agost'    => '8',
                        'Setembre' => '9',
                        'Octubre'  => '10',
                        'Novembre' => '11',
                        'Desembre' => '12',
                    ),
                    'choices_as_values' => true,
                    'preferred_choices' => array($currentnumbermonth),
                )
            )
            ->add(
                'year',
                ChoiceType::class,
                array(
                    'label' => 'backend.admin.year',
                    'required' => true,
                    'choices' => YearEnum::getEnumArray(),
                    'choices_as_values' => false,
                    'preferred_choices' => array($currentyear),
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
