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
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Knp\DoctrineBehaviors\DoctrineBehaviorsBundle;
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
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorageFactory;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;

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
            new RunroomTranslationBundle(),

            new RunroomSamplesBundle(),
        ];
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }

    /**
     * @todo: Simplify security configuration when dropping support for Symfony 4.4
     */
    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->setParameter('kernel.default_locale', 'en');

        $frameworkConfig = [
            'test' => true,
            'router' => ['utf8' => true],
            'secret' => 'secret',
        ];

        if (class_exists(NativeSessionStorageFactory::class)) {
            $frameworkConfig['session'] = ['storage_factory_id' => 'session.storage.factory.mock_file'];
        } else {
            $frameworkConfig['session'] = ['storage_id' => 'session.storage.mock_file'];
        }

        $container->loadFromExtension('framework', $frameworkConfig);

        $securityConfig = [
            'firewalls' => ['main' => []],
        ];

        if (class_exists(AuthenticatorManager::class)) {
            $securityConfig['enable_authenticator_manager'] = true;
        } else {
            $securityConfig['firewalls']['main']['anonymous'] = true;
        }

        $container->loadFromExtension('security', $securityConfig);

        $container->loadFromExtension('doctrine', [
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

    /**
     * @todo: Add typehint when dropping support for Symfony 4.4
     *
     * @psalm-suppress TooManyArguments
     *
     * @param RoutingConfigurator $routes
     */
    protected function configureRoutes($routes): void
    {
        if ($routes instanceof RoutingConfigurator) {
            $routes->add('route.entity', '/entity/{slug}')
                ->controller('controller');

            return;
        }

        $routes->add('/entity/{slug}', 'controller', 'route.entity');
    }
}
