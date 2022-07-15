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

use Doctrine\ORM\QueryBuilder;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
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

    /**
     * @var MockObject&PaginatorInterface
     */
    private $paginator;

    private BookService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(BookRepository::class);
        $this->paginator = $this->createMock(PaginatorInterface::class);

        $this->service = new BookService(
            $this->repository,
            $this->paginator
        );
    }

    /**
     * @test
     */
    public function itBuildsBooksViewModel(): void
    {
        $queryBuilder = $this->createStub(QueryBuilder::class);
        $pagination = $this->createStub(SlidingPaginationInterface::class);
        $page = 1;

        $this->repository->method('getBooksQueryBuilder')->willReturn($queryBuilder);
        $this->paginator->method('paginate')->with($queryBuilder, $page, BookService::LIMIT_PER_PAGE)->willReturn($pagination);

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
