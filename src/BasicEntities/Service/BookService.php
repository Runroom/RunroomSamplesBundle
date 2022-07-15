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
    private const LIMIT_PER_PAGE = 9;

    private BookRepository $repository;
    private PaginatorInterface $paginator;

    public function __construct(BookRepository $repository, PaginatorInterface $paginatorInterface)
    {
        $this->repository = $repository;
        $this->paginator = $paginatorInterface;
    }

    public function getBooksViewModel(int $page): BooksViewModel
    {
        $queryBuilder = $this->repository->getBooksQueryBuilder($page);

        $pagination = $this->paginator->paginate($queryBuilder, $page, self::LIMIT_PER_PAGE);

        $model = new BooksViewModel();
        $model->setPagination($pagination);

        dump($model);die;
        return $model;
    }

    public function getBookViewModel(string $slug): BookViewModel
    {
        return new BookViewModel($this->repository->findBySlug($slug));
    }
}
