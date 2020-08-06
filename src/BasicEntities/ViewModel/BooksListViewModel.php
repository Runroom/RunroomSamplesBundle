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
    protected $pagination;
    protected $paginationData;

    public function getPagination(): ?PaginationInterface
    {
        return $this->pagination;
    }

    public function setPagination(PaginationInterface $pagination): self
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
