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

use Runroom\SamplesBundle\BasicEntities\Entity\BookTranslation;
use Zenstruck\Foundry\ModelFactory;

/** @extends ModelFactory<BookTranslation> */
final class BookTranslationFactory extends ModelFactory
{
    /** @return array<string, mixed> */
    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->words(3, true),
            'slug' => self::faker()->unique()->slug(),
            'description' => self::faker()->paragraph(),
            'locale' => self::faker()->unique()->languageCode,
        ];
    }

    protected static function getClass(): string
    {
        return BookTranslation::class;
    }
}
