<?php

namespace AppBundle\Admin\Old;

use AppBundle\Admin\BaseAdmin;
use AppBundle\Enum\ReceiptTypeEnum;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\BooleanType;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\EqualType;

/**
 * Class ReceiptAdmin
 *
 * @category Admin
 */
class ReceiptAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Rebut';
    protected $baseRoutePattern = 'facturacio/rebut';
    protected $datagridValues = array(
        '_sort_by'    => 'date',
        '_sort_order' => 'asc',
        'collected'   => array('type' => EqualType::TYPE_IS_EQUAL, 'value' => BooleanType::TYPE_NO),
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
                DatePickerType::class,
                array(
                    'label' => 'backend.admin.date',
                    'format' => 'd/M/y',
                )
            )
            ->add(
                'payDate',
                DatePickerType::class,
                array(
                    'label' => 'backend.admin.payDate',
                    'format' => 'd/M/y',
                )
            )
            ->add(
                'customer',
                null,
                array(
                    'label'    => 'backend.admin.customer',
                    'required' => true,
                )
            )
            ->add(
                'description',
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
                    'required' => false,
                )
            )
            ->add(
                'type',
                'choice',
                array(
                    'label' => 'backend.admin.type',
                    'choices'  => ReceiptTypeEnum::getEnumArray(),
                    'multiple' => false,
                    'expanded' => true,
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
                'payDate',
                'doctrine_orm_date',
                array(
                    'label' => 'backend.admin.payDate',
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
                'type',
                null,
                array('label' => 'backend.admin.type'),
                'choice',
                array(
                    'expanded' => false,
                    'multiple' => false,
                    'choices' => ReceiptTypeEnum::getEnumArray(),
                )
            )
            ->add(
                'customer',
                null,
                array(
                    'label' => 'backend.admin.customer',
                )
            )
            ->add(
                'import',
                null,
                array(
                    'label' => 'backend.admin.import',
                )
            )
            ->add(
                'collected',
                null,
                array(
                    'label' => 'backend.admin.collected',
                )
            )
            ->add(
                'description',
                null,
                array(
                    'label' => 'backend.admin.annotations',
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
                'id',
                null,
                array(
                    'label'    => 'Núm.',
                    'editable' => false,
                )
            )
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
                'payDate',
                null,
                array(
                    'label'    => 'backend.admin.payDate',
                    'format'   => 'd/m/Y',
                    'editable' => true,
                )
            )
            ->add(
                'type',
                null,
                array(
                    'label'    => 'backend.admin.type',
                    'template' => '::Admin/Cells/list__cell_receipt_types.html.twig',
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
                'import',
                'integer',
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
                    'editable' => false,
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
