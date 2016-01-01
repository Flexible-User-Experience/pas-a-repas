<?php

namespace AppBundle\Admin;

use AppBundle\Enum\UserRolesEnum;
use Sonata\UserBundle\Admin\Model\UserAdmin as ParentUserAdmin;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class UserAdmin
 *
 * @category Admin
 * @package  AppBundle\Admin
 * @author   David Romaní <david@flux.cat>
 */
class UserAdmin extends ParentUserAdmin
{
    protected $classnameLabel = 'Usuari';
    protected $baseRoutePattern = 'administrador/usuari';
    protected $datagridValues = array(
        '_sort_by'    => 'username',
        '_sort_order' => 'asc',
    );

    /**
     * Available routes
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('batch');
        $collection->remove('export');
        $collection->remove('show');
    }

    /**
     * Remove batch action list view first column
     *
     * @return array
     */
    public function getBatchActions()
    {
        $actions = parent::getBatchActions();
        unset($actions['delete']);

        return $actions;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var object $formMapper */
        $formMapper
            ->with('Dades generals', array('class' => 'col-md-6'))
            ->add('firstname', null, array(
                'label' => 'Nom',
                'required' => false,
            ))
            ->add('username', null, array(
                'label' => 'Nom d\'usuari',
            ))
            ->add('email', null, array())
            ->add('plainPassword', 'text', array(
                'label' => 'Constrasenya',
                'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
            ))
            ->end()
            ->with('Administració', array('class' => 'col-md-6'))
            ->add(
                'roles',
                'choice',
                array(
                    'label' => 'Rols',
                    'choices' => UserRolesEnum::getEnumArray(),
                    'multiple' => true,
                    'expanded' => true
                )
            )
            ->add('enabled', 'sonata_type_boolean', array(
                'required' => true,
            ))
            ->end();
    }

    /**
     * @param DatagridMapper $filterMapper
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('username', null, array(
                'label' => 'Nom d\'usuari',
            ))
            ->add('email')
            ->add('roles', 'doctrine_orm_string', array(
                'label' => 'Rols',
                'choice', array('choices' => UserRolesEnum::getEnumArray()),
            ))
            ->add('enabled', null, array(
                'label' => 'Actiu',
            ));
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
            ->add('username', null, array(
                'label' => 'Nom d\'usuari',
                'editable' => true,
            ))
            ->add('email', null, array(
                'editable' => true,
            ))
            ->add('roles', null, array(
                'label' => 'Rols',
                'template' => '::Admin/Cells/list__cell_user_roles.html.twig',
            ))
            ->add('enabled', null, array(
                'label' => 'Actiu',
                'editable' => true,
            ))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                ),
                'label' => 'Accions',
            ));
    }
}
