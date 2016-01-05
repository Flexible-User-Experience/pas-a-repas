<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CustomerAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
class CustomerAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Alumne';
    protected $baseRoutePattern = 'facturacio/alumne';
    protected $datagridValues = array(
        '_sort_by'    => 'surname',
        '_sort_order' => 'asc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
//        $formMapper
//            ->with('backend.admin.schedule', $this->getFormMdSuccessBoxArray(6))
//            ->add(
//                'date',
//                'sonata_type_date_picker',
//                array(
//                    'label' => 'backend.admin.date',
//                )
//            )
//            ->end()
//            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
//            ->add(
//                'hours',
//                null,
//                array(
//                    'label'    => 'backend.admin.hours',
//                    'required' => true,
//                )
//            )
//            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
//        $datagridMapper
//            ->add(
//                'date',
//                'doctrine_orm_date',
//                array(
//                    'label'      => 'backend.admin.date',
//                    'field_type' => 'sonata_type_date_picker',
//                )
//            )
//            ->add(
//                'hours',
//                null,
//                array(
//                    'label'    => 'backend.admin.hours',
//                )
//            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add(
                'name',
                null,
                array(
                    'label'    => 'backend.admin.name',
                    'editable' => true,
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label'    => 'backend.admin.surname',
                    'editable' => true,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'backend.admin.enabled',
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
