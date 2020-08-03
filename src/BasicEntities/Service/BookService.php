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

use Knp\Component\Pager\PaginatorInterface;
use Runroom\SamplesBundle\BasicEntities\Repository\BookRepository;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BooksViewModel;
use Runroom\SamplesBundle\BasicEntities\ViewModel\BookViewModel;

class BookService
{
    /** @var int */
    private const MAX_RESULT = 10;

    /** @var BookRepository */
    private $repository;

    /** @var PaginatorInterface */
    private $paginator;

    public function __construct(
        BookRepository $repository,
        PaginatorInterface $paginator
    ) {
        $this->repository = $repository;
        $this->paginator = $paginator;
    }

    public function getBooksViewModel(int $page): BooksViewModel
    {
        // $books = $this->repository->findBy(['publish' => true], ['position' => 'ASC']);

        $queryBuilder = $this->repository->getBooksQueryBuilder();

        $pagination = $this->paginator->paginate($queryBuilder, $page, self::MAX_RESULT);

        $model = new BooksViewModel();
        $model->setPagination($pagination);
        // $model->setBooks($books);

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
