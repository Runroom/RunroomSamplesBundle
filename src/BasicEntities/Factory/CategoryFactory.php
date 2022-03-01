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

use Runroom\SamplesBundle\BasicEntities\Entity\Category;
use Zenstruck\Foundry\ModelFactory;

/** @extends ModelFactory<Category> */
final class CategoryFactory extends ModelFactory
{
    /**
     * @param string[] $locales
     * @param array<string, mixed> $defaultAttributes
     */
    public function withTranslations(array $locales, array $defaultAttributes = []): self
    {
        return $this->addState([
            'translations' => CategoryTranslationFactory::new(function () use (&$locales, $defaultAttributes): array {
                return array_merge($defaultAttributes, ['locale' => array_pop($locales)]);
            })->many(\count($locales)),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    protected function getDefaults(): array
    {
        return [
            'books' => BookFactory::new(['category' => null])->many(5),
        ];
    }

    protected static function getClass(): string
    {
        return Category::class;
    }
}
