<?php

declare(strict_types=1);

/*
 * This file is part of the RunroomSamplesBundle.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SamplesBundle\BasicEntities\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Runroom\SortableBehaviorBundle\Admin\SortableAdminTrait;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @extends AbstractAdmin<Book>
 */
class BookAdmin extends AbstractAdmin
{
    use SortableAdminTrait {
        configureRoutes as configureSortableRoutes;
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $this->configureSortableRoutes($collection);

        $collection->remove('show');
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('translations.title', null, ['label' => 'Title'])
            ->add('category');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('picture', 'image')
            ->add('title', null, [
                'sortable' => true,
                'sort_field_mapping' => ['fieldName' => 'title'],
                'sort_parent_association_mappings' => [['fieldName' => 'translations']],
            ])
            ->add('description', FieldDescriptionInterface::TYPE_HTML, [
                'sortable' => true,
                'sort_field_mapping' => ['fieldName' => 'description'],
                'sort_parent_association_mappings' => [['fieldName' => 'translations']],
            ])
            ->add('category')
            ->add('publish', null, [
                'editable' => true,
            ])
            ->add(ListMapper::NAME_ACTIONS, ListMapper::TYPE_ACTIONS, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                    'move' => ['template' => '@RunroomSortableBehavior/sort.html.twig'],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->with('Translations', [
                'box_class' => 'box box-solid box-primary',
            ])
                ->add('translations', TranslationsType::class, [
                    'label' => false,
                    'default_locale' => null,
                    'fields' => [
                        'title' => [
                            'label' => 'Title*',
                        ],
                        'slug' => [
                            'field_type' => HiddenType::class,
                        ],
                        'description' => [
                            'field_type' => CKEditorType::class,
                        ],
                    ],
                    'constraints' => [new Assert\Valid()],
                ])
            ->end()
            ->with('Extra', [
                'box_class' => 'box box-solid box-primary',
            ])
                ->add('picture', ModelListType::class, [
                    'required' => false,
                ], [
                    'link_parameters' => [
                        'context' => 'default',
                        'provider' => 'sonata.media.provider.image',
                    ],
                ])
                ->add('category')
                ->add('publish')
            ->end();
    }
}
