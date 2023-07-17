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

namespace Runroom\SamplesBundle\Tests\Common\Integration;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionConfigurationTestCase;
use Runroom\SamplesBundle\DependencyInjection\Configuration;
use Runroom\SamplesBundle\DependencyInjection\RunroomSamplesExtension;
use Runroom\SamplesBundle\Tests\App\Entity\Media;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class ConfigurationTest extends AbstractExtensionConfigurationTestCase
{
    public function testItExposesConfiguration(): void
    {
        $this->assertProcessedConfigurationEquals([
            'class' => [
                'media' => Media::class,
            ],
        ], [__DIR__ . '/../Fixtures/configuration.yaml']);
    }

    public function testItFailsOnInvalidConfiguration(): void
    {
        $this->expectException(InvalidConfigurationException::class);

        $this->assertProcessedConfigurationEquals([], [__DIR__ . '/../Fixtures/invalid_configuration.yaml']);
    }

    protected function getContainerExtension(): ExtensionInterface
    {
        return new RunroomSamplesExtension();
    }

    protected function getConfiguration(): ConfigurationInterface
    {
        return new Configuration();
    }
}
