<?php

/*
 * This file is part of the SamplesBundle.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SamplesBundle\Tests\Core\Unit;

use PHPUnit\Framework\TestCase;
use Runroom\SamplesBundle\Tests\Core\Fixtures\SortableEntity;

class SortableTest extends TestCase
{
    protected const POSITION = 42;

    /**
     * @test
     */
    public function itSetsAndGetsPosition()
    {
        $sortable = new SortableEntity();

        $sortable = $sortable->setPosition(self::POSITION);

        $this->assertSame(self::POSITION, $sortable->getPosition());
    }
}
