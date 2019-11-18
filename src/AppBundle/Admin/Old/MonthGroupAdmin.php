<?php

namespace AppBundle\Admin\Old;

use AppBundle\Admin\BaseAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\DatePickerType;

/**
 * Class MonthGroupAdmin
 *
 * @category Admin
 */
class MonthGroupAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Mes en grup';
    protected $baseRoutePattern = 'facturacio/mes-en-grup';
    protected $datagridValues = array(
        '_sort_by'    => 'date',
        '_sort_order' => 'desc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.monthgroup', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'date',
                DatePickerType::class,
                array(
                    'label' => 'backend.admin.date',
                )
            )
            ->add(
                'price',
                null,
                array(
                    'label' => 'backend.admin.price',
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
                'date',
                'doctrine_orm_date',
                array(
                    'label' => 'backend.admin.date',
                    'field_type' => DatePickerType::class,
                )
            )
            ->add(
                'customer',
                null,
                array(
                    'label'    => 'backend.admin.customer',
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
                'date',
                null,
                array(
                    'label'    => 'backend.admin.date',
                    'format'   => 'M-Y',
                    'editable' => true,
                )
            )
            ->add(
                'customer',
                null,
                array(
                    'label'    => 'backend.admin.customer',
                )
            )
            ->add(
                'shedule.hours',
                null,
                array(
                    'label'    => 'backend.admin.hours',
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
