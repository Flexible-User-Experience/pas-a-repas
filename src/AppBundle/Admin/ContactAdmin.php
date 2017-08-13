<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Class ContactAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
class ContactAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Contacte';
    protected $baseRoutePattern = 'web/missatge';
    protected $datagridValues = array(
        '_sort_by'    => 'createdAt',
        '_sort_order' => 'desc',
    );

    /**
     * Configure route collection
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('create')
            ->remove('edit')
            ->remove('batch')
            ->add('answer', $this->getRouterIdParameter() . '/answer');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'checked',
                null,
                array(
                    'label' => 'backend.admin.checked',
                )
            )
            ->add(
                'createdAt',
                'doctrine_orm_date',
                array(
                    'label'      => 'backend.admin.date',
                    'field_type' => 'sonata_type_date_picker',
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.name',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.email',
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'backend.admin.phone',
                )
            )
            ->add(
                'message',
                null,
                array(
                    'label' => 'backend.admin.message',
                )
            )
            ->add(
                'answered',
                null,
                array(
                    'label' => 'backend.admin.answered',
                )
            )
            ->add(
                'description',
                null,
                array(
                    'label' => 'backend.admin.answer',
                )
            );
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add(
                'createdAt',
                'date',
                array(
                    'label'  => 'backend.admin.date',
                    'format' => 'd/m/Y H:i',
                )
            )
            ->add(
                'checked',
                null,
                array(
                    'label' => 'backend.admin.checked',
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.name',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.email',
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'backend.admin.phone',
                )
            )
            ->add(
                'message',
                'textarea',
                array(
                    'label' => 'backend.admin.message',
                )
            )
            ->add(
                'answered',
                null,
                array(
                    'label' => 'backend.admin.answered',
                )
            );
        if ($this->getSubject()->getAnswered()) {
            $showMapper
                ->add(
                    'description',
                    'textarea',
                    array(
                        'label' => 'backend.admin.answer',
                    )
                );
        }
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add(
                'checked',
                null,
                array(
                    'label' => 'backend.admin.checked',
                )
            )
            ->add(
                'createdAt',
                'date',
                array(
                    'label'  => 'backend.admin.date',
                    'format' => 'd/m/Y'
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label' => 'backend.admin.name',
                )
            )
            ->add(
                'email',
                null,
                array(
                    'label' => 'backend.admin.email',
                )
            )
            ->add(
                'phone',
                null,
                array(
                    'label' => 'backend.admin.phone',
                )
            )
            ->add(
                'answered',
                null,
                array(
                    'label' => 'backend.admin.answered',
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'show' => array(),
                        'answer' => array(
                            'template' => '::Admin/Cells/list__action_answer.html.twig'
                        ),
                        'delete' => array(),
                    ),
                    'label'   => 'backend.admin.actions',
                )
            );
    }
}
