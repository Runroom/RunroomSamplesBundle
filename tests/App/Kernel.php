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

namespace Runroom\SamplesBundle\Tests\App;

use A2lix\AutoFormBundle\A2lixAutoFormBundle;
use A2lix\TranslationFormBundle\A2lixTranslationFormBundle;
use DAMA\DoctrineTestBundle\DAMADoctrineTestBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use FOS\CKEditorBundle\FOSCKEditorBundle;
use Knp\Bundle\MenuBundle\KnpMenuBundle;
use Runroom\DoctrineTranslatableBundle\RunroomDoctrineTranslatableBundle;
use Runroom\FormHandlerBundle\RunroomFormHandlerBundle;
use Runroom\RenderEventBundle\RunroomRenderEventBundle;
use Runroom\SamplesBundle\RunroomSamplesBundle;
use Runroom\SamplesBundle\Tests\App\Entity\Media;
use Runroom\SortableBehaviorBundle\RunroomSortableBehaviorBundle;
use Runroom\TranslationBundle\RunroomTranslationBundle;
use Sonata\AdminBundle\SonataAdminBundle;
use Sonata\Doctrine\Bridge\Symfony\SonataDoctrineBundle;
use Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle;
use Sonata\MediaBundle\SonataMediaBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [
            new A2lixAutoFormBundle(),
            new A2lixTranslationFormBundle(),
            new DAMADoctrineTestBundle(),
            new DoctrineBundle(),
            new FOSCKEditorBundle(),
            new FrameworkBundle(),
            new KnpMenuBundle(),
            new SecurityBundle(),
            new TwigBundle(),
            new SonataMediaBundle(),
            new SonataDoctrineBundle(),
            new SonataDoctrineORMAdminBundle(),
            new SonataAdminBundle(),

            new RunroomDoctrineTranslatableBundle(),
            new RunroomFormHandlerBundle(),
            new RunroomRenderEventBundle(),
            new RunroomSortableBehaviorBundle(),
            new RunroomTranslationBundle(),

            new RunroomSamplesBundle(),
        ];
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->setParameter('kernel.default_locale', 'en');

        $container->loadFromExtension('framework', [
            'annotations' => false,
            'test' => true,
            'router' => ['utf8' => true],
            'secret' => 'secret',
            'http_method_override' => false,
            'session' => ['storage_factory_id' => 'session.storage.factory.mock_file'],
        ]);

        $container->loadFromExtension('security', [
            'firewalls' => ['main' => []],
        ]);

        $container->loadFromExtension('doctrine', [
            'dbal' => [
                'url' => 'sqlite://:memory:',
                'logging' => false,
                'use_savepoints' => true,
            ],
            'orm' => [
                'auto_mapping' => true,
                'controller_resolver' => ['auto_mapping' => false],
                'mappings' => [
                    'BasicEntities' => [
                        'type' => 'attribute',
                        'dir' => '%kernel.project_dir%/../../src/BasicEntities/Entity',
                        'prefix' => 'Runroom\SamplesBundle\BasicEntities\Entity',
                        'is_bundle' => false,
                    ],
                    'Forms' => [
                        'type' => 'attribute',
                        'dir' => '%kernel.project_dir%/../../src/Forms/Entity',
                        'prefix' => 'Runroom\SamplesBundle\Forms\Entity',
                        'is_bundle' => false,
                    ],
                ],
            ],
        ]);

        $container->loadFromExtension('twig', [
            'exception_controller' => null,
            'strict_variables' => '%kernel.debug%',
        ]);

        $container->loadFromExtension('a2lix_translation_form', [
            'locales' => ['es', 'en', 'ca'],
        ]);

        $container->loadFromExtension('sonata_media', [
            'default_context' => 'default',
            'contexts' => ['default' => []],
            'cdn' => null,
            'db_driver' => 'doctrine_orm',
            'class' => ['media' => Media::class],
            'filesystem' => ['local' => null],
        ]);

        $container->loadFromExtension('runroom_samples', [
            'class' => ['media' => Media::class],
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->add('route.entity', '/entity/{slug}')
            ->controller('controller');
    }
}
