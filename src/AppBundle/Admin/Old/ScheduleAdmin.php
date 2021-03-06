<?php

namespace AppBundle\Admin\Old;

use AppBundle\Admin\BaseAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\DatePickerType;

/**
 * Class ScheduleAdmin
 *
 * @category Admin
 */
class ScheduleAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Parte';
    protected $baseRoutePattern = 'facturacio/parte';
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
            ->with('backend.admin.schedule', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'date',
                DatePickerType::class,
                array(
                    'label' => 'backend.admin.date',
                    'format' => 'd/M/y',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'hours',
                null,
                array(
                    'label'    => 'backend.admin.hours',
                    'required' => true,
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
                    'label'      => 'backend.admin.date',
                    'field_type' => DatePickerType::class,
                    'format' => 'd/M/y',
                ),
                null,
                array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                )
            )
            ->add(
                'hours',
                null,
                array(
                    'label'    => 'backend.admin.hours',
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
                'date',
                array(
                    'label'    => 'backend.admin.date',
                    'format'   => 'd/m/Y',
                    'editable' => true,
                )
            )
            ->add(
                'hours',
                'integer',
                array(
                    'label'    => 'backend.admin.hours',
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
