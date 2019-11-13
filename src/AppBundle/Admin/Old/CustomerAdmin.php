<?php

namespace AppBundle\Admin\Old;

use AppBundle\Admin\BaseAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Sonata\CoreBundle\Form\Type\EqualType;

/**
 * Class CustomerAdmin
 *
 * @category Admin
 */
class CustomerAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Alumne';
    protected $baseRoutePattern = 'facturacio/alumne';
    protected $datagridValues = array(
        '_sort_by'    => 'surname',
        '_sort_order' => 'asc',
        'enabled'     => array('type' => EqualType::TYPE_IS_EQUAL, 'value' => BooleanType::TYPE_YES),
    );

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('show')
            ->remove('batch')
            ->add('receipt', $this->getRouterIdParameter() . '/receipt');
    }

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
                    'attr'     => array(
                        'style' => 'resize:vertical',
                        'rows'  => 5,
                    )
                )
            )
            ->end()
            ->with('backend.admin.address', $this->getFormMdSuccessBoxArray(6))
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
            ->end()
        ;
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
                ->end()
            ;
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
                'course',
                null,
                array(
                    'label'    => 'backend.admin.course',
                )
            )
            ->add(
                'singleClasses',
                null,
                array(
                    'label'    => 'backend.admin.singleClasses',
                )
            )
            ->add(
                'groupClasses',
                null,
                array(
                    'label'    => 'backend.admin.groupClasses',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label'    => 'backend.admin.enabled',
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
                'phones',
                null,
                array(
                    'label'    => 'backend.admin.phone',
                )
            )
            ->add(
                'course',
                null,
                array(
                    'label'    => 'backend.admin.course',
                    'editable' => true,
                )
            )
            ->add(
                'singleClasses',
                null,
                array(
                    'label'    => 'backend.admin.singleClasses',
                    'editable' => true,
                )
            )
            ->add(
                'groupClasses',
                null,
                array(
                    'label'    => 'backend.admin.groupClasses',
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
                        'edit' => array(
                            'template' => '::Admin/Buttons/list__action_edit_button.html.twig',
                        ),
                        'receipt'=> array(
                            'template' => '::Admin/Buttons/list__action_receipt.html.twig'
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
