<?php

namespace AppBundle\Admin\Old;

use AppBundle\Admin\BaseAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class PhoneAdmin
 *
 * @category Admin
 */
class PhoneAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Telèfon';
    protected $baseRoutePattern = 'facturacio/telefon';
    protected $datagridValues = array(
        '_sort_by'    => 'position',
        '_sort_order' => 'asc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.phone', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'number',
                null,
                array(
                    'label' => 'backend.admin.number',
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'type',
                null,
                array(
                    'label'    => 'backend.admin.type',
                    'required' => true,
                )
            )
            ->add(
                'position',
                null,
                array(
                    'label'    => 'backend.admin.position',
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
                'number',
                null,
                array(
                    'label' => 'backend.admin.number',
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
                'type',
                null,
                array(
                    'label' => 'backend.admin.type',
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
                'number',
                null,
                array(
                    'label'    => 'backend.admin.number',
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
                'type',
                null,
                array(
                    'label'    => 'backend.admin.type',
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
            )
        ;
    }
}
