<?php

/*
 * This file is part of the SamplesBundle.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SamplesBundle\Tests\BasicEntities\Unit;

use PHPUnit\Framework\TestCase;
use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Runroom\SamplesBundle\BasicEntities\Controller\BookController;
use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BooksViewModel;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BookViewModel;
use Symfony\Component\HttpFoundation\Response;

class BookControllerTest extends TestCase
{
    private const INDEX_VIEW = '@Samples/BasicEntities/books.html.twig';
    private const AJAX_FORM_VIEW = '@Samples/BasicEntities/book.html.twig';

    private $renderer;
    private $service;
    private $controller;

    protected function setUp(): void
    {
        $this->renderer = $this->prophesize(PageRenderer::class);
        $this->service = $this->prophesize(BookService::class);

        $this->controller = new BookController(
            $this->renderer->reveal(),
            $this->service->reveal()
        );
    }

    /**
     * @test
     */
    public function itRenderBooks()
    {
        $expectedResponse = new Response();
        $model = new BooksViewModel();

        $this->service->getBooksViewModel()->willReturn($model);

        $this->renderer->renderResponse(self::INDEX_VIEW, $model, null)
            ->willReturn($expectedResponse);

        $response = $this->controller->books();

        $this->assertSame($expectedResponse, $response);
    }

    /**
     * @test
     */
    public function itRenderBook()
    {
        $expectedResponse = new Response();
        $model = new BookViewModel();

        $this->service->getBookViewModel('book')->willReturn($model);
        $this->renderer->renderResponse(self::AJAX_FORM_VIEW, $model, null)
            ->willReturn($expectedResponse);

        $response = $this->controller->book('book');

        $this->assertSame($expectedResponse, $response);
    }
}
