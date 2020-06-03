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

namespace Runroom\SamplesBundle\BasicEntities\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Symfony\Component\HttpFoundation\RequestStack;

class BookRepository extends ServiceEntityRepository
{
    /** @var RequestStack */
    private $requestStack;

    public function __construct(ManagerRegistry $registry, RequestStack $requestStack)
    {
        parent::__construct($registry, Book::class);

        $this->requestStack = $requestStack;
    }

    public function findBySlug(string $slug): Book
    {
        $request = $this->requestStack->getCurrentRequest();

        $query = $this->createQueryBuilder('book')
            ->leftJoin('book.translations', 'translations', Join::WITH, 'translations.locale = :locale')
            ->where('translations.slug = :slug')
            ->andWhere('book.publish = true')
            ->setParameter('slug', $slug)
            ->setParameter('locale', $request->getLocale())
            ->getQuery();

        return $query->getSingleResult();
    }
}
