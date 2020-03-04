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

namespace Runroom\SamplesBundle\BasicEntities\Controller;

use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Symfony\Component\HttpFoundation\Response;

class BookController
{
    protected $renderer;
    protected $service;

    public function __construct(
        PageRenderer $renderer,
        BookService $service
    ) {
        $this->renderer = $renderer;
        $this->service = $service;
    }

    public function books(): Response
    {
        $model = $this->service->getBooksViewModel();

        return $this->renderer->renderResponse(
            '@Samples/BasicEntities/books.html.twig',
            $model
        );
    }

    public function book(string $slug): Response
    {
        $model = $this->service->getBookViewModel($slug);

        return $this->renderer->renderResponse(
            '@Samples/BasicEntities/book.html.twig',
            $model
        );
    }
}
