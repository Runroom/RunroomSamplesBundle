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

namespace Runroom\SamplesBundle\Forms\Admin;

use Runroom\SamplesBundle\Forms\Entity\Contact;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter;
use Sonata\Form\Type\DateTimeRangePickerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/** @extends AbstractAdmin<Contact> */
class ContactAdmin extends AbstractAdmin
{
    protected function configureDefaultSortValues(array &$sortValues): void
    {
        $sortValues['_sort_order'] = 'DESC';
        $sortValues['_sort_by'] = 'date';
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->remove('create');
        $collection->remove('edit');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('date', null, ['format' => 'd/m/Y h:i'])
            ->add('name')
            ->add('email')
            ->add('phone')
            ->add('subject', 'choice', [
                'catalogue' => 'messages',
                'choices' => array_flip(Contact::$subjectChoices),
            ])
            ->add('type', 'choice', [
                'catalogue' => 'messages',
                'choices' => array_flip(Contact::$typeChoices),
            ])
            ->add('preferences', 'choice', [
                'catalogue' => 'messages',
                'choices' => array_flip(Contact::$preferenceChoices),
                'multiple' => true,
            ])
            ->add('comment')
            ->add('newsletter')
            ->add('privacyPolicy')
            ->add('status', 'choice', [
                'catalogue' => 'messages',
                'choices' => array_flip(Contact::$statusChoices),
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('date', DateRangeFilter::class, ['field_type' => DateTimeRangePickerType::class])
            ->add('name')
            ->add('email')
            ->add('subject', null, [
                'field_type' => ChoiceType::class,
                'field_options' => ['choices' => Contact::$subjectChoices],
            ])
            ->add('newsletter')
            ->add('status', null, [
                'field_type' => ChoiceType::class,
                'field_options' => ['choices' => Contact::$statusChoices],
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('date', null, ['format' => 'd/m/Y h:i'])
            ->addIdentifier('name')
            ->add('email', 'email')
            ->add('subject', 'choice', [
                'catalogue' => 'messages',
                'choices' => array_flip(Contact::$subjectChoices),
            ])
            ->add('newsletter')
            ->add('status', 'choice', [
                'catalogue' => 'messages',
                'choices' => array_flip(Contact::$statusChoices),
                'editable' => true,
                'template' => '@Samples/Forms/sonata/contact-status.html.twig',
            ])
            ->add('_action', 'actions', [
                'actions' => ['delete' => []],
            ]);
    }
}
