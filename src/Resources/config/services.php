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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Runroom\FormHandlerBundle\FormHandlerInterface;
use Runroom\RenderEventBundle\Renderer\PageRendererInterface;
use Runroom\SamplesBundle\BasicEntities\Admin\BookAdmin;
use Runroom\SamplesBundle\BasicEntities\Admin\CategoryAdmin;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Runroom\SamplesBundle\BasicEntities\Entity\Category;
use Runroom\SamplesBundle\Forms\Admin\ContactAdmin;
use Runroom\SamplesBundle\Forms\Entity\Contact;
use Runroom\SamplesBundle\Forms\Form\ContactHubspotEventHandler;
use SevenShores\Hubspot\Endpoints\Forms;
use SevenShores\Hubspot\Http\Client;

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
        ->tag('sonata.admin', [
            'model_class' => Book::class,
            'manager_type' => 'orm',
            'label' => 'Books',
        ]);

    $services->set(CategoryAdmin::class)
        ->public()
        ->tag('sonata.admin', [
            'model_class' => Category::class,
            'manager_type' => 'orm',
            'label' => 'Categories',
        ]);

    // Forms
    $services->alias(PageRendererInterface::class, 'runroom.render_event.renderer.page');
    $services->alias(FormHandlerInterface::class, 'runroom.form_handler.form_handler');

    $services->load('Runroom\SamplesBundle\Forms\Controller\\', '../../Forms/Controller')
        ->public()
        ->tag('controller.service_arguments');

    $services->set(ContactAdmin::class)
        ->public()
        ->tag('sonata.admin', [
            'model_class' => Contact::class,
            'manager_type' => 'orm',
            'label' => 'Contacts',
        ]);

    $services->set(Client::class)
        ->arg('$config', ['key' => env('HUBSPOT_KEY')]);

    $services->set(Forms::class)
        ->bind('$client', service(Client::class));

    $services->set(ContactHubspotEventHandler::class)
        ->bind('$portalId', env('HUBSPOT_PORTAL_ID'))
        ->bind('$formId', env('HUBSPOT_FORM_ID'));
};
