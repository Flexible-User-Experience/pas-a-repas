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
            ->with('backend.admin.receipt', $this->getFormMdSuccessBoxArray(9))
            ->add(
                'date',
//                'sonata_type_date_picker',
                null,
                array(
                    'label' => 'backend.admin.date',
                )
            )
            ->add(
                'payDate',
                null,
                array(
                    'label' => 'backend.admin.payDate',
//                    'sonata_type_date_picker',
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
                null,
                array(
                    'label' => 'backend.admin.date',
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
                null,
                array(
                    'label' => 'backend.admin.payDate',
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
                'payDate',
                null,
                array(
                    'label' => 'backend.admin.payDate',
                    'format'   => 'd/m/Y',
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
