<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;

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
    protected $baseRoutePattern = 'web/contacte';
    protected $datagridValues = array(
        '_sort_by'    => 'date',
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
            ->remove('show')
            ->remove('delete')
            ->remove('batch')
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
                null,
                array(
                    'label' => 'backend.admin.date',
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
                )
            )
            ->add(
                'name',
                null,
                array(
                    'label'    => 'backend.admin.name',
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
                'phone',
                null,
                array(
                    'label'    => 'backend.admin.phone',
                )
            )
            ->add(
                'message',
                null,
                array(
                    'label'    => 'backend.admin.message',
                )
            );
    }
}
