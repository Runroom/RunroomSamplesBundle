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
     * @psalm-var SlidingPaginationInterface
     */
    protected $pagination;

    /** @var array<mixed> */
    protected $paginationData;

    /** @phpstan-return SlidingPaginationInterface<Book>|null
     * @psalm-return SlidingPaginationInterface|null
     */
    public function getPagination(): ?SlidingPaginationInterface
    {
        return $this->pagination;
    }

    /**
     * @phpstan-param SlidingPaginationInterface<Book> $pagination
     * @psalm-param SlidingPaginationInterface $pagination
     * */
    public function setPagination(SlidingPaginationInterface $pagination): self
    {
        $this->pagination = $pagination;
        $this->paginationData = $pagination->getPaginationData();

        return $this;
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
