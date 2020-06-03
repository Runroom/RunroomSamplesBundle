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
    /** @var BookRepository */
    private $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getBooksViewModel(): BooksViewModel
    {
        $books = $this->repository->findBy(['publish' => true], ['position' => 'ASC']);

        $model = new BooksViewModel();
        $model->setBooks($books);

        return $model;
    }

    public function getBookViewModel(string $slug): BookViewModel
    {
        $book = $this->repository->findBySlug($slug);

        $model = new BookViewModel();
        $model->setBook($book);

        return $model;
    }
}
