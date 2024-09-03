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
use Runroom\SamplesBundle\BasicEntities\Factory\BookFactory;
use Runroom\SamplesBundle\BasicEntities\Repository\BookRepository;
use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Zenstruck\Foundry\Test\Factories;

class BookServiceTest extends TestCase
{
    use Factories;

    private MockObject&BookRepository $repository;
    private BookService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(BookRepository::class);

        $this->service = new BookService($this->repository);
    }

    public function testItBuildsBooksViewModel(): void
    {
        $expectedBooks = [BookFactory::createOne()];

        $this->repository->method('findBy')->with(['publish' => true], ['position' => 'ASC'])->willReturn($expectedBooks);

        $model = $this->service->getBooksViewModel();

        static::assertSame($model->getBooks(), $expectedBooks);
    }

    public function testItBuildsBookViewModel(): void
    {
        $expectedBook = BookFactory::new()->withTranslations(['es', 'en'])->create();

        $this->repository->method('findBySlug')->with('slug')->willReturn($expectedBook);

        $model = $this->service->getBookViewModel('slug');

        static::assertSame($model->getBook(), $expectedBook);
    }
}
