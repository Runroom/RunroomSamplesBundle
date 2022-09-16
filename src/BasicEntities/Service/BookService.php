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

namespace Runroom\SamplesBundle\BasicEntities\Service;

use Runroom\SamplesBundle\BasicEntities\Repository\BookRepository;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BooksViewModel;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BookViewModel;

class BookService
{
    public const LIMIT_PER_PAGE = 6;

    private BookRepository $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getBooksViewModel(int $page): BooksViewModel
    {
        $pagination = $this->repository->getPaginatedBooks($page, self::LIMIT_PER_PAGE);

        return new BooksViewModel($pagination);
    }

    public function getBookViewModel(string $slug): BookViewModel
    {
        return new BookViewModel($this->repository->findBySlug($slug));
    }
}
