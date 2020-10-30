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

namespace Runroom\SamplesBundle\Tests\BasicEntities\Unit;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Runroom\SamplesBundle\BasicEntities\Controller\BookController;
use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BooksViewModel;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BookViewModel;
use Symfony\Component\HttpFoundation\Response;

class BookControllerTest extends TestCase
{
    private const BOOKS_VIEW = '@RunroomSamples/BasicEntities/books.html.twig';
    private const BOOK_VIEW = '@RunroomSamples/BasicEntities/book.html.twig';

    /** @var MockObject&PageRenderer */
    private $renderer;

    /** @var MockObject&BookService */
    private $service;

    /** @var BookController */
    private $controller;

    protected function setUp(): void
    {
        $this->renderer = $this->createMock(PageRenderer::class);
        $this->service = $this->createMock(BookService::class);

        $this->controller = new BookController(
            $this->renderer,
            $this->service
        );
    }

    /** @test */
    public function itRenderBooks(): void
    {
        $expectedResponse = new Response();
        $model = new BooksViewModel();

        $this->service->method('getBooksViewModel')->with()->willReturn($model);
        $this->renderer->method('renderResponse')->with(self::BOOKS_VIEW, $model, null)
            ->willReturn($expectedResponse);

        $response = $this->controller->books();

        self::assertSame($expectedResponse, $response);
    }

    /** @test */
    public function itRenderBook(): void
    {
        $expectedResponse = new Response();
        $model = new BookViewModel();

        $this->service->method('getBookViewModel')->with('book')->willReturn($model);
        $this->renderer->method('renderResponse')->with(self::BOOK_VIEW, $model, null)
            ->willReturn($expectedResponse);

        $response = $this->controller->book('book');

        self::assertSame($expectedResponse, $response);
    }
}
