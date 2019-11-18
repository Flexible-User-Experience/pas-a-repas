<?php

namespace AppBundle\Admin\Old;

use AppBundle\Admin\BaseAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\BooleanType;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\EqualType;

/**
 * Class HourSingleAdmin
 *
 * @category Admin
 */
class HourSingleAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Hora Particular';
    protected $baseRoutePattern = 'facturacio/hora-particular';
    protected $datagridValues = array(
        '_sort_by'    => 'date',
        '_sort_order' => 'desc',
        'invoiced'    => array('type' => EqualType::TYPE_IS_EQUAL, 'value' => BooleanType::TYPE_NO),
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.hoursingle', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'date',
                DatePickerType::class,
                array(
                    'label' => 'backend.admin.date',
                )
            )
            ->add(
                'customer',
                null,
                array(
                    'label' => 'backend.admin.customer',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'price',
                null,
                array(
                    'label' => 'backend.admin.price',
                    'required' => true,
                )
            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.amount',
                    'required' => true,
                )
            )
            ->add(
                'invoiced',
                null,
                array(
                    'label' => 'backend.admin.invoiced',
                    'required' => false,
                )
            )
            ->end()
        ;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'customer',
                null,
                array(
                    'label'    => 'backend.admin.customer',
                )
            )
            ->add(
                'date',
                'doctrine_orm_date',
                array(
                    'label' => 'backend.admin.date',
                    'field_type' => DatePickerType::class,
                )
            )
            ->add(
                'amount',
                null,
                array(
                    'label'    => 'backend.admin.amount',
                )
            )
            ->add(
                'price',
                null,
                array(
                    'label'    => 'backend.admin.price',
                )
            )
            ->add(
                'invoiced',
                null,
                array(
                    'label' => 'backend.admin.invoiced',
                )
            )
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add(
                'customer',
                null,
                array(
                    'label'    => 'backend.admin.customer',
                )
            )
            ->add(
                'date',
                'date',
                array(
                    'label'    => 'backend.admin.date',
                    'format'   => 'd/m/Y',
                    'editable' => true,
                )
            )
            ->add(
                'amount',
                'integer',
                array(
                    'label'    => 'backend.admin.amount',
                    'editable' => true,
                )
            )
            ->add(
                'price',
                'integer',
                array(
                    'label'    => 'backend.admin.price',
                    'editable' => true,
                )
            )
            ->add(
                'invoiced',
                null,
                array(
                    'label'    => 'backend.admin.invoiced',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'edit' => array(
                            'template' => '::Admin/Buttons/list__action_edit_button.html.twig',
                        ),
                        'delete' => array(
                            'template' => '::Admin/Buttons/list__action_delete_button.html.twig',
                        ),
                    ),
                    'label'   => 'backend.admin.actions',
                )
            )
        ;
    }
}
