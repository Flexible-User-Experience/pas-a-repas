<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class ReceiptAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class ReceiptAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Rebut';
    protected $baseRoutePattern = 'facturacio/rebut';
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
            ->with('backend.admin.receipt', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'date',
                'sonata_type_date_picker',
                array(
                    'label' => 'backend.admin.date',
                )
            )
            ->add(
                'payDate',
                'sonata_type_date_picker',
                array(
                    'label' => 'backend.admin.payDate',
                )
            )
            ->end()
             ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'import',
                null,
                array(
                    'label' => 'backend.admin.import',
                    'required' => true,
                )
            )
            ->add(
                'collected',
                null,
                array(
                    'label' => 'backend.admin.collected',
                    'required' => true,
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
            ->add(
                'customer',
                null,
                array(
                    'label'    => 'backend.admin.customer',
                )
            )
            ->add(
                'collected',
                null,
                array(
                    'label'    => 'backend.admin.collected',
                )
            )
            ->add(
                'payDate',
                'doctrine_orm_date',
                array(
                    'label' => 'backend.admin.payDate',
                    'field_type' => 'sonata_type_date_picker',
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
            ->add(
                'customer',
                null,
                array(
                    'label'    => 'backend.admin.customer',
                    'editable' => true,
                )
            )
            ->add(
                'type',
                null,
                array(
                    'label'    => 'backend.admin.type',
                    'editable' => true,
                )
            )
            ->add(
                'payDate',
                null,
                array(
                    'label' => 'backend.admin.payDate',
                    'format'   => 'd/m/Y',
                    'editable' => true,
                )
            )
            ->add(
                'import',
                null,
                array(
                    'label' => 'backend.admin.import',
                    'editable' => true,
                )
            )
            ->add(
                'collected',
                null,
                array(
                    'label' => 'backend.admin.collected',
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