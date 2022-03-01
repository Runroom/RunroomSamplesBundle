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

namespace Runroom\SamplesBundle\Tests\BasicEntities\Integration;

use Runroom\SamplesBundle\BasicEntities\Admin\CategoryAdmin;
use Runroom\SamplesBundle\BasicEntities\Entity\Category;
use Runroom\Testing\TestCase\SonataAdminTestCase;

/** @extends SonataAdminTestCase<Category> */
class CategoryAdminTest extends SonataAdminTestCase
{
    /**
     * @test
     */
    public function itHasAllListFields(): void
    {
        $this->assertAdminListContainsField('name');
        $this->assertAdminListContainsField('books');
        $this->assertAdminListContainsField('_action');
    }

    /**
     * @test
     */
    public function itHasAllFormFields(): void
    {
        $this->assertAdminFormContainsField('translations');
        $this->assertAdminFormContainsField('books');
    }

    /**
     * @test
     */
    public function itHasAllFilterFields(): void
    {
        $this->assertAdminFilterContainsField('translations.name');
        $this->assertAdminFilterContainsField('books');
    }

    protected function getAdminClass(): string
    {
        return CategoryAdmin::class;
    }
}
