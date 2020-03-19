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

namespace Runroom\SamplesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Sonata\MediaBundle\Model\Media;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('runroom_samples');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('class')
                    ->children()
                        ->scalarNode('media')
                            ->cannotBeEmpty()
                            ->validate()
                                ->ifTrue(function ($config) {
                                    return !is_a($config, Media::class, true);
                                })
                                ->thenInvalid('%s must extend ' . Media::class)
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
