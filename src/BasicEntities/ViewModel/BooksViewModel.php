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
use Runroom\SamplesBundle\BasicEntities\Entity\Book;

class BooksViewModel
{
    protected $pagination;
    protected $paginationData;
    /** @var Book[] */
    private $books;

    /** @param Book[] $books */
    public function setBooks(array $books): void
    {
        $this->books = $books;
    }

    /** @return Book[]|null */
    public function getBooks(): ?array
    {
        return $this->books;
    }

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

    public function getPaginationData(string $data): ?int
    {
        return $this->paginationData[$data] ?? null;
    }

    public function getNextPage(): ?int
    {
        return $this->getPaginationData('next');
    }

    public function getPreviousPage(): ?int
    {
        return $this->getPaginationData('previous');
    }
}
