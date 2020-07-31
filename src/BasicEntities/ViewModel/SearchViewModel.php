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

use Pagerfanta\Pagerfanta;

final class SearchViewModel
{
    /** @var PagerFanta|null */
    private $books;

    /** @var array|null */
    private $filters;

    public function setBooks(PagerFanta $books): self
    {
        $this->books = $books;

        return $this;
    }

    public function getBooks(): ?Pagerfanta
    {
        return $this->books;
    }

    public function setFilters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }

    public function getFilters(): ?array
    {
        return $this->filters;
    }
}
