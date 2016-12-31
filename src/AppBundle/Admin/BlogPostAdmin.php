<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BlogPostAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->with('Content', array(
                'class' => 'col-md-8',
                'box_class'   => 'box box-solid box-danger',
                'description' => 'Lorem ipsum'
            ))
                ->add('title', 'text')
                ->add('body')
                ->add('shortDescription', 'sonata_formatter_type', array(
                    'source_field'         => 'body',
                    'source_field_options' => array('attr' => array('class' => 'span10', 'rows' => 20)),
                    'format_field'         => 'body',
                    'target_field'         => 'description',
                    'ckeditor_context'     => 'default',
                    'event_dispatcher'     => $formMapper->getFormBuilder()->getEventDispatcher()
                ))
                ->add('draft')
            ->end()

            ->with('Meta data', array('class' => 'col-md-4'))
                ->add('categorypost', 'sonata_type_model', array(
                    'class' => 'AppBundle\Entity\CategoryPost',
                    'property' => 'name',
                    'sortable' => true,
                    'label' => false,
                ))
            ->end()

            /*->with('Meta data', array('class' => 'col-md-4'))
            ->add('category', 'sonata_type_model_autocomplete', array(
                'class' => 'AppBundle\Entity\Category',
                'property' => 'name',
                'multiple' => 'true',
                'template' => 'AppBundle:Form/Type:sonata_type_model_autocomplete.html.twig',
            ))
            ->end()*/
        ;

    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('body')
            ->add('categorypost.name')
            ->add('draft', 'boolean')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('body')
            ->add('categorypost.name')
            ->add('draft', 'boolean')

            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array(
                'operator_type' => 'sonata_type_boolean'
            ))
            ->add('body', null, array(
                'operator_type' => 'hidden',
                'advanced_filter' => false
            ))
            ->add('categorypost', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\CategoryPost',
                'choice_label' => 'name',
            ))
        ;
    }

    public function toString($object)
    {
        return $object->getTitle() ?: 'Post'; // shown in the breadcrumb on the create view
    }
}