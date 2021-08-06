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

namespace Runroom\SamplesBundle\BasicEntities\Factory;

use Runroom\SamplesBundle\BasicEntities\Entity\CategoryTranslation;
use Zenstruck\Foundry\ModelFactory;

/** @extends ModelFactory<CategoryTranslation> */
final class CategoryTranslationFactory extends ModelFactory
{
    /** @return array<string, mixed> */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->words(3, true),
            'locale' => self::faker()->unique()->languageCode(),
        ];
    }

    protected static function getClass(): string
    {
        return CategoryTranslation::class;
    }
}
