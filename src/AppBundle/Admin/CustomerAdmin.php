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
        $formMapper
            ->with('backend.admin.customer', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'name',
                null,
                array(
                    'label'    => 'backend.admin.name',
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label'    => 'backend.admin.surname',
                )
            )
            ->add(
                'father',
                null,
                array(
                    'label'    => 'backend.admin.father',
                )
            )
            ->add(
                'mother',
                null,
                array(
                    'label'    => 'backend.admin.mother',
                )
            )
            ->add(
                'course',
                null,
                array(
                    'label'    => 'backend.admin.course',
                )
            )
            ->add(
                'school',
                null,
                array(
                    'label'    => 'backend.admin.school',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label'    => 'backend.admin.email',
                )
            )
            ->add(
                'annotations',
                null,
                array(
                    'label'    => 'backend.admin.annotations',
                    'required' => false,
                )
            )
            ->end()
            ->with('backend.admin.adress', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'address',
                null,
                array(
                    'label'    => 'backend.admin.address',
                )
            )
            ->add(
                'city',
                null,
                array(
                    'label'    => 'backend.admin.city',
                )
            )
            ->add(
                'postalCode',
                null,
                array(
                    'label'    => 'backend.admin.postalCode',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'backend.admin.enabled',
                    'required' => false,
                )
            )
            ->add(
                'priceHourSingle',
                null,
                array(
                    'label'    => 'backend.admin.priceHourSingle',
                    'required' => false,
                )
            )
            ->add(
                'priceHourGroup',
                null,
                array(
                    'label'    => 'backend.admin.priceHourGroup',
                    'required' => false,
                )
            )
            ->add(
                'singleClasses',
                null,
                array(
                    'label'    => 'backend.admin.singleClasses',
                    'required' => false,
                )
            )
            ->add(
                'groupClasses',
                null,
                array(
                    'label'    => 'backend.admin.groupClasses',
                    'required' => false,
                )
            )
            ->end();
        if ($this->id($this->getSubject())) { // is edit mode, disable on new subjects
            $formMapper
                ->with('backend.admin.phones', $this->getFormMdSuccessBoxArray(12))
                ->add(
                    'phones',
                    'sonata_type_collection',
                    array(
                        'label'    => ' ',
                        'required' => false,
                        'cascade_validation' => true,
                    ),
                    array(
                        'edit'     => 'inline',
                        'inline'   => 'table',
                        'sortable' => 'position',
                    )
                )

                ->end();
        }
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'name',
                null,
                array(
                    'label'    => 'backend.admin.name',
                )
            )
            ->add(
                'surname',
                null,
                array(
                    'label'    => 'backend.admin.surname',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'backend.admin.enabled',
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
                'total',
                null,
                array(
                    'label'    => 'backend.admin.total',
                    'template' => '::Admin/Cells/list__cell_customer_total_field.html.twig',
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
