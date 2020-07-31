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

namespace Runroom\SamplesBundle\BasicEntities\ElasticSearch;

use Elastica\Aggregation\Terms;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Pagerfanta\Pagerfanta;

final class BookFinder
{
    /** @var PaginatedFinderInterface */
    private $bookFinder;

    public function __construct(PaginatedFinderInterface $bookFinder)
    {
        $this->bookFinder = $bookFinder;
    }

    public function find(): Pagerfanta
    {
        $boolQuery = $this->buildQuery();

        $termsAgg = new Terms("colors");
        $termsAgg->setField("product_taxons");

        $query = new Query($boolQuery);
        $query->addSort('position');
        $query->addAggregation($termsAgg);

        $products = $this->bookFinder->findPaginated($query);
        $products->setMaxPerPage(10);
        $products->setCurrentPage(1);

        return $products;
    }

    private function buildQuery(): BoolQuery
    {
        $query = new BoolQuery();

        return $query;
    }
}
