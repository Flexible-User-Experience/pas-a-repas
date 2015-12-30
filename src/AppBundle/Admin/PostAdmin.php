<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class PostAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
class PostAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Article';
    protected $baseRoutePattern = 'web/article';
    protected $datagridValues = array(
        '_sort_by'    => 'publishedDate',
        '_sort_order' => 'desc',
    );

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add(
                'publishedDate',
                null,
                array(
                    'label' => 'backend.admin.published_date',
                )
            )
            ->add(
                'title',
                null,
                array(
                    'label' => 'backend.admin.title',
                )
            )
            ->add(
                'description',
                null,
                array(
                    'label' => 'backend.admin.description',
                    'attr' => array(
                        'rows' => 7,
                    ),
                    'required' => false,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'backend.admin.enabled',
                    'required' => false,
                )
            );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add(
                'publishedDate',
                null,
                array(
                    'label' => 'backend.admin.published_date',
                )
            )
            ->add(
                'title',
                null,
                array(
                    'label' => 'backend.admin.title',
                )
            )->add(
                'description',
                null,
                array(
                    'label' => 'backend.admin.description',
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'backend.admin.enabled',
                )
            );
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add(
                'publishedDate',
                null,
                array(
                    'label'    => 'backend.admin.published_date',
                    'editable' => true,
                )
            )
            ->add(
                'title',
                null,
                array(
                    'label'    => 'backend.admin.title',
                    'editable' => true,
                )
            )
            ->add(
                'enabled',
                null,
                array(
                    'label' => 'backend.admin.enabled',
                    'editable' => true,
                )
            )
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'edit' => array(),
                    ),
                    'label'   => 'backend.admin.actions',
                )
            );
    }
}
