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

use Runroom\SamplesBundle\BasicEntities\Admin\BookAdmin;
use Runroom\SamplesBundle\BasicEntities\Admin\CategoryAdmin;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Runroom\SamplesBundle\BasicEntities\Entity\Category;
use Runroom\SamplesBundle\Forms\Admin\ContactAdmin;
use Runroom\SamplesBundle\Forms\Entity\Contact;
use Runroom\SamplesBundle\Forms\Form\ContactHubspotEventHandler;
use Runroom\SortableBehaviorBundle\Controller\SortableAdminController;
use SevenShores\Hubspot\Http\Client;
use SevenShores\Hubspot\Resources\Forms;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('Runroom\SamplesBundle\\', '../../*')
        ->exclude('../../{Resources,DependencyInjection}');

    // BasicEntities
    $services->load('Runroom\SamplesBundle\BasicEntities\Controller\\', '../../BasicEntities/Controller')
        ->public()
        ->tag('controller.service_arguments');

    $services->set(BookAdmin::class)
        ->public()
        ->args([null, Book::class, SortableAdminController::class])
        ->tag('sonata.admin', ['manager_type' => 'orm', 'label' => 'Books']);

    $services->set(CategoryAdmin::class)
        ->public()
        ->args([null, Category::class, null])
        ->tag('sonata.admin', ['manager_type' => 'orm', 'label' => 'Categories']);

    // Forms
    $services->load('Runroom\SamplesBundle\Forms\Controller\\', '../../Forms/Controller')
        ->public()
        ->tag('controller.service_arguments');

    $services->set(ContactAdmin::class)
        ->public()
        ->args([null, Contact::class, null])
        ->tag('sonata.admin', ['manager_type' => 'orm', 'label' => 'Contacts']);

    $services->set(Client::class)
        ->arg('$config', ['key' => '%env(HUBSPOT_KEY)%']);

    $services->set(Forms::class)
        ->bind('$client', ref(Client::class));

    $services->set(ContactHubspotEventHandler::class)
        ->bind('$portalId', '%env(HUBSPOT_PORTAL_ID)%')
        ->bind('$formId', '%env(HUBSPOT_FORM_ID)%');
};
