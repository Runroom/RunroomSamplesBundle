<?php

declare(strict_types=1);

/*
 * This file is part of the SamplesBundle.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SamplesBundle\Controller;

use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    protected $renderer;

    public function __construct(PageRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function home(): Response
    {
        return $this->renderer->renderResponse('@Samples/home.html.twig');
    }
}
