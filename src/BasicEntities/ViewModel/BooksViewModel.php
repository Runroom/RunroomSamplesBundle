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

namespace Runroom\SamplesBundle\BasicEntities\ViewModel;

use Knp\Bundle\PaginatorBundle\Pagination\SlidingPaginationInterface;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;

class BooksViewModel
{
    /**
     * @phpstan-var SlidingPaginationInterface<Book>
     *
     * @psalm-var SlidingPaginationInterface
     */
    protected $pagination;

    /** @var array<mixed> */
    protected $paginationData;

    /**
     * @phpstan-param SlidingPaginationInterface<Book> $slidingPaginationInterface
     *
     * @psalm-param SlidingPaginationInterface $slidingPaginationInterface
     */
    public function __construct(SlidingPaginationInterface $slidingPaginationInterface)
    {
        $this->pagination = $slidingPaginationInterface;
        $this->paginationData = $slidingPaginationInterface->getPaginationData();
    }

    /** @phpstan-return SlidingPaginationInterface<Book>|null
     * @psalm-return SlidingPaginationInterface|null
     */
    public function getPagination(): ?SlidingPaginationInterface
    {
        return $this->pagination;
    }

    public function getPreviousPage(): ?int
    {
        return $this->getPaginationData('previous');
    }

    public function getNextPage(): ?int
    {
        return $this->getPaginationData('next');
    }

    public function getPaginationData(string $data): ?int
    {
        return $this->paginationData[$data] ?? null;
    }
}
