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
use Runroom\SamplesBundle\BasicEntities\Controller\BookController;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BooksViewModel;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BookViewModel;
use Symfony\Component\DependencyInjection\Container;
use Twig\Environment;

class BookControllerTest extends TestCase
{
    /**
     * @var MockObject&BookService
     */
    private $service;

    /**
     * @var MockObject&Environment
     */
    private $twig;

    /**
     * @var BookController
     */
    private $controller;

    protected function setUp(): void
    {
        $this->service = $this->createMock(BookService::class);
        $this->twig = $this->createMock(Environment::class);

        $container = new Container();
        $container->set('twig', $this->twig);

        $this->controller = new BookController($this->service);
        $this->controller->setContainer($container);
    }

    /**
     * @test
     */
    public function itRenderBooks(): void
    {
        $model = new BooksViewModel([]);

        $this->service->method('getBooksViewModel')->willReturn($model);

        $response = $this->controller->books();

        self::assertSame(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function itRenderBook(): void
    {
        $model = new BookViewModel(new Book());

        $this->service->method('getBookViewModel')->with('book')->willReturn($model);

        $response = $this->controller->book('book');

        self::assertSame(200, $response->getStatusCode());
    }
}
