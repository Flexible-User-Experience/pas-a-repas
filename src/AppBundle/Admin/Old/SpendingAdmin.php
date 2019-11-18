<?php

namespace AppBundle\Admin\Old;

use AppBundle\Admin\BaseAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\DatePickerType;

/**
 * Class SpendingAdmin
 *
 * @category Admin
 */
class SpendingAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Despesa';
    protected $baseRoutePattern = 'despesa/despesa';
    protected $datagridValues = array(
        '_sort_by'    => 'date',
        '_sort_order' => 'asc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.spending', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'date',
                DatePickerType::class,
                array(
                    'label' => 'backend.admin.date',
                    'format' => 'd/M/y',
                )
            )
            ->add(
                'spendingCategory',
                null,
                array(
                    'label' => 'backend.admin.category',
                )
            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.amount',
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
                    'format' => 'd/M/y',
                ),
                null,
                array(
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy',
                )
            )
            ->add(
                'spendingCategory',
                null,
                array(
                    'label' => 'backend.admin.category',
                )
            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.amount',
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
                    'format'   => 'd/m/Y',
                    'editable' => true,
                )
            )
            ->add(
                'spendingCategory',
                null,
                array(
                    'label' => 'backend.admin.category',
                    'editable' => true,
                )
            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.amount',
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
