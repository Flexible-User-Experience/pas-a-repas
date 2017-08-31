<?php

namespace AppBundle\Form\Type;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class ContactType.
 *
 * @category FormType
 *
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
                TextType::class,
                array(
                    'label' => 'frontend.index.contact.form.name',
                    'required' => true,
                )
            )
            ->add(
                'email',
                EmailType::class,
                array(
                    'label' => 'frontend.index.contact.form.email',
                    'required' => true,
                )
            )
            ->add(
                'phone',
                TextType::class,
                array(
                    'label' => 'frontend.index.contact.form.phone',
                    'required' => false,
                )
            )
            ->add(
                'message',
                TextareaType::class,
                array(
                    'label' => 'frontend.index.contact.form.message',
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
                    'label' => 'frontend.index.contact.form.submit',
                    'attr' => array(
                        'class' => 'btn-violet',
                    ),
                )
            )
            ->add(
                'captcha',
                EWZRecaptchaType::class,
                array(
                    'label' => ' ',
                    'attr' => array(
                        'options' => array(
                            'theme' => 'light',
                            'type' => 'image',
                            'size' => 'normal',
                        ),
                    ),
                    'mapped' => false,
                    'constraints' => array(
                        new RecaptchaTrue(),
                    ),
                )
            )
        ;
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
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Contact',
            )
        );
    }
}
