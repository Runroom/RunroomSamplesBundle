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

namespace Runroom\SamplesBundle\Tests\Forms\Integration;

use Runroom\SamplesBundle\Forms\Admin\ContactAdmin;
use Runroom\Testing\TestCase\SonataAdminTestCase;

class ContactAdminTest extends SonataAdminTestCase
{
    /** @test */
    public function itHasAllShowFields(): void
    {
        $this->assertAdminShowContainsField('date');
        $this->assertAdminShowContainsField('name');
        $this->assertAdminShowContainsField('email');
        $this->assertAdminShowContainsField('phone');
        $this->assertAdminShowContainsField('subject');
        $this->assertAdminShowContainsField('type');
        $this->assertAdminShowContainsField('preferences');
        $this->assertAdminShowContainsField('comment');
        $this->assertAdminShowContainsField('newsletter');
        $this->assertAdminShowContainsField('privacyPolicy');
        $this->assertAdminShowContainsField('status');
    }

    /** @test */
    public function itHasAllListFields(): void
    {
        $this->assertAdminListContainsField('date');
        $this->assertAdminListContainsField('name');
        $this->assertAdminListContainsField('email');
        $this->assertAdminListContainsField('subject');
        $this->assertAdminListContainsField('newsletter');
        $this->assertAdminListContainsField('status');
        $this->assertAdminListContainsField('_action');
    }

    /** @test */
    public function itHasAllFilterFields(): void
    {
        $this->assertAdminFilterContainsField('date');
        $this->assertAdminFilterContainsField('name');
        $this->assertAdminFilterContainsField('email');
        $this->assertAdminFilterContainsField('subject');
        $this->assertAdminFilterContainsField('newsletter');
        $this->assertAdminFilterContainsField('status');
    }

    /** @test */
    public function itDoesNotHaveDisabledRoutes(): void
    {
        $this->assertAdminRoutesDoesNotContainRoute('create');
        $this->assertAdminRoutesDoesNotContainRoute('edit');
    }

    /** @test */
    public function itDoesDefineDefaultFilterParameters(): void
    {
        $this->assertAdminFilterParametersContainsFilter('_sort_order', 'DESC');
        $this->assertAdminFilterParametersContainsFilter('_sort_by', 'date');
    }

    protected function getAdminClass(): string
    {
        return ContactAdmin::class;
    }
}
