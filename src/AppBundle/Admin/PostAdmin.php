<?php

namespace AppBundle\Admin;

use AppBundle\Repository\CategoryRepository;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

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
        '_sort_by'    => 'publishedAt',
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
            ->remove('batch');
    }

    /**
     * Override query list to reduce queries amount on list view (apply join strategy)
     *
     * @param string $context context
     *
     * @return QueryBuilder
     */
    public function createQuery($context = 'list')
    {
        /** @var QueryBuilder $query */
        $query = parent::createQuery($context);
        $query
            ->select($query->getRootAliases()[0] . ', c')
            ->leftJoin($query->getRootAliases()[0] . '.categories', 'c');

        return $query;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('backend.admin.post', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'publishedAt',
                'sonata_type_date_picker',
                array(
                    'label' => 'backend.admin.published_date',
                )
            )
            ->add(
                'imageFile',
                'file',
                array(
                    'label'    => 'backend.admin.image',
                    'help'     => $this->getImageHelperFormMapperWithThumbnail(),
                    'required' => false,
                )
            )
            ->end()
            ->with('backend.admin.controls', $this->getFormMdSuccessBoxArray(6))
            ->add(
                'categories',
                null,
                array(
                    'label' => 'backend.admin.categories',
                    'query_builder' => function (CategoryRepository $repository) {
                        return $repository->getAllSortedByTitleQB();
                    },
                )
            )
            ->add(
                'metaKeywords',
                null,
                array(
                    'label' => 'backend.admin.metakeywords',
                    'help'  => 'backend.admin.metakeywordshelp',
                )
            )
            ->add(
                'metaDescription',
                null,
                array(
                    'label' => 'backend.admin.metadescription',
                )
            )
            ->add(
                'enabled',
                'checkbox',
                array(
                    'label'    => 'backend.admin.enabled',
                    'required' => false,
                )
            )
            ->end()
            ->with('backend.admin.content', $this->getFormMdSuccessBoxArray(12))
            ->add(
                'title',
                null,
                array(
                    'label' => 'backend.admin.title',
                )
            )
            ->add(
                'description',
                'ckeditor',
                array(
                    'label'       => 'backend.admin.description',
                    'config_name' => 'my_config',
                    'required'    => true,
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
                'publishedAt',
                'doctrine_orm_date',
                array(
                    'label'      => 'backend.admin.published_date',
                    'field_type' => 'sonata_type_date_picker',
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
                'categories',
                null,
                array(
                    'label' => 'backend.admin.categories',
                )
            )
            ->add(
                'description',
                null,
                array(
                    'label' => 'backend.admin.description',
                )
            )
            ->add(
                'metaKeywords',
                null,
                array(
                    'label' => 'backend.admin.metakeywords',
                )
            )
            ->add(
                'metaDescription',
                null,
                array(
                    'label' => 'backend.admin.metadescription',
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
        unset($this->listModes['mosaic']);
        $listMapper
            ->add(
                'image',
                null,
                array(
                    'label'    => 'backend.admin.image',
                    'template' => '::Admin/Cells/list__cell_image_field.html.twig'
                )
            )
            ->add(
                'publishedAt',
                'date',
                array(
                    'label'    => 'backend.admin.published_date',
                    'format'   => 'd/m/Y',
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
                'categories',
                null,
                array(
                    'label'    => 'backend.admin.categories',
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
                        'show'   => array(),
                        'edit'   => array(),
                        'delete' => array(),
                    ),
                    'label'   => 'backend.admin.actions',
                )
            );
    }
}
