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
use Runroom\SortableBehaviorBundle\Admin\AbstractSortableAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Validator\Constraints as Assert;

/** @extends AbstractSortableAdmin<Book> */
class BookAdmin extends AbstractSortableAdmin
{
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
            ->addIdentifier('title', null, [
                'sortable' => true,
                'sort_field_mapping' => ['fieldName' => 'title'],
                'sort_parent_association_mappings' => [['fieldName' => 'translations']],
            ])
            ->add('description', 'html', [
                'sortable' => true,
                'sort_field_mapping' => ['fieldName' => 'description'],
                'sort_parent_association_mappings' => [['fieldName' => 'translations']],
            ])
            ->add('category')
            ->add('publish', null, [
                'editable' => true,
            ])
            ->add('_action', 'actions', [
                'actions' => [
                    'delete' => [],
                    'move' => [
                        'template' => '@SortableBehavior/sort.html.twig',
                    ],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('translations', TranslationsType::class, [
                'label' => false,
                'fields' => [
                    'title' => [],
                    'slug' => [
                        'display' => false,
                    ],
                    'description' => [
                        'field_type' => CKEditorType::class,
                        'required' => false,
                    ],
                ],
                'constraints' => [
                    new Assert\Valid(),
                ],
            ])
            ->add('category')
            ->add('picture', MediaType::class, [
                'context' => 'default',
                'provider' => 'sonata.media.provider.image',
            ])
            ->add('publish');
    }
}
