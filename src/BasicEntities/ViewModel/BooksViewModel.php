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

    /**
     * @phpstan-param SlidingPaginationInterface<Book> $pagination
     *
     * @psalm-param SlidingPaginationInterface $pagination
     */
    public function __construct(SlidingPaginationInterface $pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * @phpstan-return SlidingPaginationInterface<Book>
     *
     * @psalm-return SlidingPaginationInterface
     */
    public function getPagination(): SlidingPaginationInterface
    {
        return $this->pagination;
    }
}
