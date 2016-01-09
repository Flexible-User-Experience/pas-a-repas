<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class MonthGroupAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   Anton Serra <aserratorta@gmail.com>
 */
class MonthGroupAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Mes en grup';
    protected $baseRoutePattern = 'facturacio/mes_en_grup';
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
//            ->with('backend.admin.monthgroup', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'date',
                null,
                array(
                    'label' => 'backend.admin.date',
                )
            )
//            ->end()
//            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
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
                    'required' => true,
                )
            );
//            ->end();

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
                    'format'   => '('
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
                    'label'    => 'backend.admin.invoiced',
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
