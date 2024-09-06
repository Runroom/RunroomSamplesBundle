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

namespace Runroom\SamplesBundle\DependencyInjection;

use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Sonata\Doctrine\Mapper\Builder\OptionsBuilder;
use Sonata\Doctrine\Mapper\DoctrineCollector;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * @TODO: Remove this if when Symfony 6 support is dropped
 */
if (!class_exists(Extension::class)) {
    class_alias(\Symfony\Component\HttpKernel\DependencyInjection\Extension::class, Extension::class);
}

class RunroomSamplesExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        /**
         * @var array{ class: array{ media: class-string } }
         */
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.php');

        $this->mapMediaField('picture', Book::class, $config);
    }

    /**
     * @param array{ class: array{ media: class-string } } $config
     *
     * @phpstan-param class-string $entityName
     */
    private function mapMediaField(string $fieldName, string $entityName, array $config): void
    {
        $options = OptionsBuilder::createManyToOne($fieldName, $config['class']['media'])
            ->cascade(['all'])
            ->addJoin([
                'name' => 'picture_id',
                'referencedColumnName' => 'id',
            ]);

        DoctrineCollector::getInstance()->addAssociation($entityName, 'mapManyToOne', $options);
    }
}
