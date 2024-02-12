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
use Runroom\SamplesBundle\Forms\Entity\Contact;
use Runroom\Testing\TestCase\SonataAdminTestCase;
use Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * @extends SonataAdminTestCase<Contact>
 */
class ContactAdminTest extends SonataAdminTestCase
{
    public function testItHasAllShowFields(): void
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

    public function testItHasAllListFields(): void
    {
        $this->assertAdminListContainsField('date');
        $this->assertAdminListContainsField('name');
        $this->assertAdminListContainsField('email');
        $this->assertAdminListContainsField('subject');
        $this->assertAdminListContainsField('newsletter');
        $this->assertAdminListContainsField('status');
        $this->assertAdminListContainsField(ListMapper::NAME_ACTIONS);
    }

    public function testItHasAllFilterFields(): void
    {
        $this->assertAdminFilterContainsField('date');
        $this->assertAdminFilterContainsField('name');
        $this->assertAdminFilterContainsField('email');
        $this->assertAdminFilterContainsField('subject');
        $this->assertAdminFilterContainsField('newsletter');
        $this->assertAdminFilterContainsField('status');
    }

    public function testItDoesNotHaveDisabledRoutes(): void
    {
        $this->assertAdminRoutesDoesNotContainRoute('create');
        $this->assertAdminRoutesDoesNotContainRoute('edit');
    }

    public function testItDoesDefineDefaultFilterParameters(): void
    {
        $this->assertAdminFilterParametersContainsFilter('_sort_order', 'DESC');
        $this->assertAdminFilterParametersContainsFilter('_sort_by', 'date');
    }

    protected function getAdminClass(): string
    {
        return ContactAdmin::class;
    }
}
