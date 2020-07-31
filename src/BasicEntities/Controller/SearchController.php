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

namespace Runroom\SamplesBundle\BasicEntities\Controller;

use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Runroom\SamplesBundle\BasicEntities\Service\SearchService;
use Symfony\Component\HttpFoundation\Response;

class SearchController
{
    /** @var PageRenderer */
    private $renderer;

    /** @var SearchService */
    private $service;

    public function __construct(
        PageRenderer $renderer,
        SearchService $service
    ) {
        $this->renderer = $renderer;
        $this->service = $service;
    }

    public function search(): Response
    {
        $model = $this->service->getSearchViewModel();

        return $this->renderer->renderResponse(
            '@RunroomSamples/BasicEntities/books.html.twig',
            $model
        );
    }
}
