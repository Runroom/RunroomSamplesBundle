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

use Runroom\BaseBundle\Entity\Media;
use Runroom\SamplesBundle\BasicEntities\Book;
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
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');
        $loader->load('admin.yaml');

        $this->mapMediaField('picture', Book::class);
    }

    protected function mapMediaField(string $fieldName, string $entityName): void
    {
        $options = OptionsBuilder::create()
            ->add('fieldName', $fieldName)
            ->add('targetEntity', Media::class)
            ->add('cascade', ['all'])
            ->add('mappedBy', null)
            ->add('inversedBy', null)
            ->add('joinColumns', [['referencedColumnName' => 'id']])
            ->add('orphanRemoval', false);

        DoctrineCollector::getInstance()->addAssociation($entityName, 'mapManyToOne', $options);
    }
}
