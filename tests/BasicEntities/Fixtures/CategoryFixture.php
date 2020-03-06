<?php

/*
 * This file is part of the SamplesBundle.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SamplesBundle\Tests\BasicEntities\Fixtures;

use Runroom\SamplesBundle\BasicEntities\Entity\Category;

class CategoryFixture
{
    protected const NAME = 'name';

    public static function create(): Category
    {
        $category = new Category();
        $category->translate()->setName(self::NAME);

        return $category;
    }
}
