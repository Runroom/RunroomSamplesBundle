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

namespace Runroom\SamplesBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class RunroomSamplesBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
