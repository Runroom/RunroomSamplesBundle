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

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPaginationInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Runroom\SamplesBundle\BasicEntities\Factory\BookFactory;
use Runroom\SamplesBundle\BasicEntities\Repository\BookRepository;
use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Zenstruck\Foundry\Test\Factories;

class BookServiceTest extends TestCase
{
    use Factories;

    /**
     * @var MockObject&BookRepository
     */
    private $repository;

    private BookService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(BookRepository::class);
        $this->service = new BookService($this->repository);
    }

    /**
     * @test
     */
    public function itBuildsBooksViewModel(): void
    {
        $pagination = $this->createStub(SlidingPaginationInterface::class);
        $page = 1;

        $this->repository->method('getPaginatedBooks')->willReturn($pagination);

        $model = $this->service->getBooksViewModel($page);

        static::assertSame($model->getPagination(), $pagination);
    }

    /**
     * @test
     */
    public function itBuildsBookViewModel(): void
    {
        $expectedBook = BookFactory::new()->withTranslations(['es', 'en'])->create()->object();

        $this->repository->method('findBySlug')->with('slug')->willReturn($expectedBook);

        $model = $this->service->getBookViewModel('slug');

        static::assertSame($model->getBook(), $expectedBook);
    }
}
