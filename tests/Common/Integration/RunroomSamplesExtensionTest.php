<?php

declare(strict_types=1);

/*
 * This file is part of the Runroom package.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SamplesBundle\Tests\Common\Integration;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Runroom\SamplesBundle\DependencyInjection\RunroomSamplesExtension;
use Runroom\SamplesBundle\BasicEntities\Admin\BookAdmin;
use Runroom\SamplesBundle\BasicEntities\Admin\CategoryAdmin;
use Runroom\SamplesBundle\BasicEntities\Controller\BookController;
use Runroom\SamplesBundle\BasicEntities\Repository\BookRepository;
use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Runroom\SamplesBundle\Forms\Admin\ContactAdmin;
use Runroom\SamplesBundle\Forms\Controller\ContactController;
use Runroom\SamplesBundle\Forms\Form\ContactEventHandler;
use Runroom\SamplesBundle\Forms\Form\ContactHubspotEventHandler;
use Runroom\SamplesBundle\Forms\Form\Type\ContactFormType;
use Runroom\SamplesBundle\Forms\Form\Type\ContactHubspotFormType;
use Runroom\SamplesBundle\Forms\Service\ContactService;
use Runroom\SamplesBundle\Tests\App\Entity\Media;

class RunroomSamplesExtensionTest extends AbstractExtensionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->load(['class' => [
            'media' => Media::class,
        ]]);
    }

    /** @test */
    public function itHasCoreServicesAlias(): void
    {
        // Basic Entities
        $this->assertContainerBuilderHasService(BookAdmin::class);
        $this->assertContainerBuilderHasService(CategoryAdmin::class);
        $this->assertContainerBuilderHasService(BookController::class);
        $this->assertContainerBuilderHasService(BookService::class);
        $this->assertContainerBuilderHasService(BookRepository::class);

        // Forms
        $this->assertContainerBuilderHasService(ContactAdmin::class);
        $this->assertContainerBuilderHasService(ContactController::class);
        $this->assertContainerBuilderHasService(ContactFormType::class);
        $this->assertContainerBuilderHasService(ContactHubspotFormType::class);
        $this->assertContainerBuilderHasService(ContactEventHandler::class);
        $this->assertContainerBuilderHasService(ContactHubspotEventHandler::class);
        $this->assertContainerBuilderHasService(ContactService::class);
    }

    protected function getContainerExtensions(): array
    {
        return [new RunroomSamplesExtension()];
    }
}
