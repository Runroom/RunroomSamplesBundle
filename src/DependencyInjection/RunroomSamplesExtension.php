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
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class RunroomSamplesExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        /** @var array{ class: array{ media: class-string } } */
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $this->mapMediaField('picture', Book::class, $config);
    }

    /** @param array{ class: array{ media: class-string } } $config */
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
