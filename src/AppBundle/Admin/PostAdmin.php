<?php

namespace AppBundle\Admin;

use AppBundle\Repository\CategoryRepository;
use Doctrine\ORM\QueryBuilder;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * Class PostAdmin.
 *
 * @category Admin
 */
class PostAdmin extends BaseAdmin
{
    protected $classnameLabel = 'Article';
    protected $baseRoutePattern = 'web/article';
    protected $datagridValues = array(
        '_sort_by' => 'publishedAt',
        '_sort_order' => 'desc',
    );

    /**
     * Configure route collection.
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('batch');
    }

    /**
     * Override query list to reduce queries amount on list view (apply join strategy).
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
            ->select($query->getRootAliases()[0].', c')
            ->leftJoin($query->getRootAliases()[0].'.categories', 'c');

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
                DatePickerType::class,
                array(
                    'label' => 'backend.admin.published_date',
                    'format' => 'd/M/y',
                )
            )
            ->add(
                'imageFile',
                FileType::class,
                array(
                    'label' => 'backend.admin.image',
                    'help' => $this->getImageHelperFormMapperWithThumbnail(),
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
                    'help' => 'backend.admin.metakeywordshelp',
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
                CheckboxType::class,
                array(
                    'label' => 'backend.admin.enabled',
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
                CKEditorType::class,
                array(
                    'label' => 'backend.admin.description',
                    'config_name' => 'my_config',
                    'required' => true,
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
                'publishedAt',
                'doctrine_orm_date',
                array(
                    'label' => 'backend.admin.published_date',
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
                'image',
                null,
                array(
                    'label' => 'backend.admin.image',
                    'template' => '::Admin/Cells/list__cell_image_field.html.twig',
                )
            )
            ->add(
                'publishedAt',
                'date',
                array(
                    'label' => 'backend.admin.published_date',
                    'format' => 'd/m/Y',
                    'editable' => true,
                )
            )
            ->add(
                'title',
                null,
                array(
                    'label' => 'backend.admin.title',
                    'editable' => true,
                )
            )
            ->add(
                'categories',
                null,
                array(
                    'label' => 'backend.admin.categories',
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
                        'show' => array(
                            'template' => '::Admin/Buttons/list__action_show_button.html.twig',
                        ),
                        'edit' => array(
                            'template' => '::Admin/Buttons/list__action_edit_button.html.twig',
                        ),
                        'delete' => array(
                            'template' => '::Admin/Buttons/list__action_delete_button.html.twig',
                        ),
                    ),
                    'label' => 'backend.admin.actions',
                )
            )
        ;
    }
}
