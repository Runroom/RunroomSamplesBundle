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

use Runroom\SamplesBundle\BasicEntities\ElasticSearch\BookFinder;
use Runroom\SamplesBundle\BasicEntities\ViewModel\SearchViewModel;

final class SearchService
{
    /** @var BookFinder */
    private $bookFinder;

    public function __construct(BookFinder $bookFinder)
    {
        $this->bookFinder = $bookFinder;
    }

    public function getSearchViewModel(): SearchViewModel
    {
        $books = $this->bookFinder->find();
        $filters = $this->buildFilters($books->getAdapter()->getAggregations());

        $searchViewModel = new SearchViewModel();
        $searchViewModel->setBooks($books);
        $searchViewModel->setFilters($filters);

        return $searchViewModel;
    }

    private function buildFilters(array $aggregations): array
    {
        return [];
    }
}
