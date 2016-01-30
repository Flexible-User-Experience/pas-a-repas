<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class SpendingAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class SpendingAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Despesa';
    protected $baseRoutePattern = 'facturacio/despesa';
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
                'sonata_type_date_picker',
                array(
                    'label' => 'backend.admin.date',
                )
            )
//            ->add(
//                'spending_category',
//                null,
//                array(
//                    'label' => 'backend.admin.name',
//                )
//            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.amount',
                )
            )
            ->end();
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
                    'field_type' => 'sonata_type_date_picker',
                )
            )
//            ->add(
//                'spendingCategory',
//                null,
//                array(
//                    'label' => 'backend.admin.name',
//                )
//            )
            ->add(
                'amount',
                null,
                array(
                    'label' => 'backend.admin.amount',
                )
            );
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
//            ->add(
//                'spendingcategory',
//                null,
//                array(
//                    'label' => 'backend.admin.name',
//                    'editable' => true,
//                )
//            )
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
                        'edit'   => array(),
                        'delete' => array(),
                    ),
                    'label'   => 'backend.admin.actions',
                )
            );
    }
}
