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

use Runroom\SamplesBundle\BasicEntities\Admin\BookAdmin;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Runroom\Testing\TestCase\SonataAdminTestCase;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * @extends SonataAdminTestCase<Book>
 */
class BookAdminTest extends SonataAdminTestCase
{
    public function testItHasAllListFields(): void
    {
        $this->assertAdminListContainsField('picture');
        $this->assertAdminListContainsField('title');
        $this->assertAdminListContainsField('description');
        $this->assertAdminListContainsField('category');
        $this->assertAdminListContainsField('publish');
        $this->assertAdminListContainsField(ListMapper::NAME_ACTIONS);
    }

    public function testItHasAllFormFields(): void
    {
        $this->assertAdminFormContainsField('translations');
        $this->assertAdminFormContainsField('category');
        $this->assertAdminFormContainsField('picture');
        $this->assertAdminFormContainsField('publish');
    }

    public function testItHasAllFilterFields(): void
    {
        $this->assertAdminFilterContainsField('translations.title');
        $this->assertAdminFilterContainsField('category');
    }

    protected function getAdminClass(): string
    {
        return BookAdmin::class;
    }
}
