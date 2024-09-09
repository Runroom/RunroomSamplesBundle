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
    public function __construct(private readonly BookRepository $repository) {}

    public function getBooksViewModel(): BooksViewModel
    {
        return new BooksViewModel($this->repository->findBy(['publish' => true], ['position' => 'ASC']));
    }

    public function getBookViewModel(string $slug): BookViewModel
    {
        return new BookViewModel($this->repository->findBySlug($slug));
    }
}
