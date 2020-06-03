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

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Runroom\SamplesBundle\BasicEntities\Repository\BookRepository;
use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BooksViewModel;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BookViewModel;
use Runroom\SamplesBundle\Tests\BasicEntities\Fixtures\BookFixture;

class BookServiceTest extends TestCase
{
    use ProphecyTrait;

    /** @var ObjectProphecy<BookRepository> */
    private $repository;

    /** @var BookService */
    private $service;

    protected function setUp(): void
    {
        $this->repository = $this->prophesize(BookRepository::class);

        $this->service = new BookService($this->repository->reveal());
    }

    /** @test */
    public function itBuildsBooksViewModel(): void
    {
        $expectedBooks = [BookFixture::create()];

        $this->repository->findBy(['publish' => true], ['position' => 'ASC'])->willReturn($expectedBooks);

        $model = $this->service->getBooksViewModel();

        $this->assertInstanceOf(BooksViewModel::class, $model);
        $this->assertSame($model->getBooks(), $expectedBooks);
    }

    /** @test */
    public function itBuildsBookViewModel(): void
    {
        $expectedBook = BookFixture::create();

        $this->repository->findBySlug('slug')->willReturn($expectedBook);

        $model = $this->service->getBookViewModel('slug');

        $this->assertInstanceOf(BookViewModel::class, $model);
        $this->assertSame($model->getBook(), $expectedBook);
    }
}
