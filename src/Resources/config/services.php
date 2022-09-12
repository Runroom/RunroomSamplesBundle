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

use Runroom\FormHandlerBundle\FormHandler;
use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Runroom\SamplesBundle\BasicEntities\Admin\BookAdmin;
use Runroom\SamplesBundle\BasicEntities\Admin\CategoryAdmin;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Runroom\SamplesBundle\BasicEntities\Entity\Category;
use Runroom\SamplesBundle\Forms\Admin\ContactAdmin;
use Runroom\SamplesBundle\Forms\Entity\Contact;
use Runroom\SamplesBundle\Forms\Form\ContactHubspotEventHandler;
use SevenShores\Hubspot\Endpoints\Forms;
use SevenShores\Hubspot\Http\Client;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ReferenceConfigurator;

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

    $bookAdmin = $services->set(BookAdmin::class)
        ->public()
        ->tag('sonata.admin', [
            'model_class' => Book::class,
            'manager_type' => 'orm',
            'label' => 'Books',
        ]);

    /**
     * @todo: Simplify this when dropping support for SonataAdminBundle 3
     */
    if (!is_a(CRUDController::class, AbstractController::class, true)) {
        $bookAdmin->args([null, Book::class, null]);
    }

    $categoryAdmin = $services->set(CategoryAdmin::class)
        ->public()
        ->tag('sonata.admin', [
            'model_class' => Category::class,
            'manager_type' => 'orm',
            'label' => 'Categories',
        ]);

    /**
     * @todo: Simplify this when dropping support for SonataAdminBundle 3
     */
    if (!is_a(CRUDController::class, AbstractController::class, true)) {
        $categoryAdmin->args([null, Category::class, null]);
    }

    // Forms
    $services->alias(PageRenderer::class, 'runroom.render_event.renderer.page');
    $services->alias(FormHandler::class, 'runroom.form_handler.form_handler');

    $services->load('Runroom\SamplesBundle\Forms\Controller\\', '../../Forms/Controller')
        ->public()
        ->tag('controller.service_arguments');

    $contactAdmin = $services->set(ContactAdmin::class)
        ->public()
        ->tag('sonata.admin', [
            'model_class' => Contact::class,
            'manager_type' => 'orm',
            'label' => 'Contacts',
        ]);

    /**
     * @todo: Simplify this when dropping support for SonataAdminBundle 3
     */
    if (!is_a(CRUDController::class, AbstractController::class, true)) {
        $contactAdmin->args([null, Contact::class, null]);
    }

    $services->set(Client::class)
        ->arg('$config', ['key' => '%env(HUBSPOT_KEY)%']);

    $services->set(Forms::class)
        ->bind('$client', new ReferenceConfigurator(Client::class));

    $services->set(ContactHubspotEventHandler::class)
        ->bind('$portalId', '%env(HUBSPOT_PORTAL_ID)%')
        ->bind('$formId', '%env(HUBSPOT_FORM_ID)%');
};
