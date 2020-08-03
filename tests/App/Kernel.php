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
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use FOS\CKEditorBundle\FOSCKEditorBundle;
use Knp\Bundle\MenuBundle\KnpMenuBundle;
use Knp\DoctrineBehaviors\DoctrineBehaviorsBundle;
use Runroom\FormHandlerBundle\RunroomFormHandlerBundle;
use Runroom\RenderEventBundle\RunroomRenderEventBundle;
use Runroom\SamplesBundle\RunroomSamplesBundle;
use Runroom\SamplesBundle\Tests\App\Entity\Media;
use Runroom\SortableBehaviorBundle\RunroomSortableBehaviorBundle;
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
use Symfony\Component\Routing\RouteCollectionBuilder;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [
            new A2lixAutoFormBundle(),
            new A2lixTranslationFormBundle(),
            new DoctrineBehaviorsBundle(),
            new DoctrineBundle(),
            new FOSCKEditorBundle(),
            new FrameworkBundle(),
            new KnpMenuBundle(),
            new KnpPaginatorBundle(),
            new SecurityBundle(),
            new TwigBundle(),
            new SonataMediaBundle(),
            new SonataDoctrineBundle(),
            new SonataDoctrineORMAdminBundle(),
            new SonataAdminBundle(),

            new RunroomFormHandlerBundle(),
            new RunroomRenderEventBundle(),
            new RunroomSortableBehaviorBundle(),
            new RunroomSamplesBundle(),
        ];
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader): void
    {
        $c->setParameter('kernel.default_locale', 'en');

        $c->loadFromExtension('framework', [
            'test' => true,
            'router' => ['utf8' => true],
            'secret' => 'secret',
            'session' => ['storage_id' => 'session.storage.mock_file'],
        ]);

        $c->loadFromExtension('security', [
            'firewalls' => ['main' => ['anonymous' => true]],
        ]);

        $c->loadFromExtension('doctrine', [
            'dbal' => ['url' => 'sqlite://:memory:', 'logging' => false],
            'orm' => [
                'auto_mapping' => true,
                'mappings' => [
                    'BasicEntities' => [
                        'type' => 'annotation',
                        'dir' => '%kernel.project_dir%/../../src/BasicEntities/Entity',
                        'prefix' => 'Runroom\SamplesBundle\BasicEntities\Entity',
                        'is_bundle' => false,
                    ],
                    'Forms' => [
                        'type' => 'annotation',
                        'dir' => '%kernel.project_dir%/../../src/Forms/Entity',
                        'prefix' => 'Runroom\SamplesBundle\Forms\Entity',
                        'is_bundle' => false,
                    ],
                ],
            ],
        ]);

        $c->loadFromExtension('twig', [
            'exception_controller' => null,
            'strict_variables' => '%kernel.debug%',
        ]);

        $c->loadFromExtension('a2lix_translation_form', [
            'locales' => ['es', 'en', 'ca'],
        ]);

        $c->loadFromExtension('sonata_media', [
            'default_context' => 'default',
            'contexts' => ['default' => []],
            'cdn' => null,
            'db_driver' => 'doctrine_orm',
            'class' => ['media' => Media::class],
            'filesystem' => ['local' => null],
        ]);

        $c->loadFromExtension('runroom_samples', [
            'class' => ['media' => Media::class],
        ]);
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $routes->add('/entity/{slug}', 'controller', 'route.entity');
    }
}
