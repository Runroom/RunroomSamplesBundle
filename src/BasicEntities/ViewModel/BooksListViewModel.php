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

use Knp\Component\Pager\Pagination\PaginationInterface;

class BooksListViewModel
{
    /** @var PaginationInterface */
    protected $pagination;

    /** @var array */
    protected $paginationData;

    /** @return PaginationInterface|null */
    public function getPagination(): ?PaginationInterface
    {
        return $this->pagination;
    }

    /** @return BookListViewModel */
    public function setPagination(PaginationInterface $pagination): self
    {
        $this->pagination = $pagination;
        $this->paginationData = $pagination->getPaginationData();

        return $this;
    }

    /** @return int|null */
    public function getPreviousPage(): ?int
    {
        return $this->getPaginationData('previous');
    }

    /** @return int|null */
    public function getNextPage(): ?int
    {
        return $this->getPaginationData('next');
    }

    /** return int|null */
    public function getPaginationData(string $data): ?int
    {
        return $this->paginationData[$data] ?? null;
    }
}
