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
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @psalm-suppress PropertyNotSetInConstructor
 *
 * $_em, $_entityName and $_class are not directly set on this class but on parent classes
 */
class BookRepository extends ServiceEntityRepository
{
    private RequestStack $requestStack;

    public function __construct(ManagerRegistry $registry, RequestStack $requestStack)
    {
        parent::__construct($registry, Book::class);

        $this->requestStack = $requestStack;
    }

    public function findBySlug(string $slug): Book
    {
        $request = $this->requestStack->getCurrentRequest() ?? new Request();

        $query = $this->createQueryBuilder('book')
            ->leftJoin('book.translations', 'translations', Join::WITH, 'translations.locale = :locale')
            ->where('translations.slug = :slug')
            ->andWhere('book.publish = true')
            ->setParameter('slug', $slug)
            ->setParameter('locale', $request->getLocale())
            ->getQuery();

        return $query->getSingleResult();
    }

    public function getBooksQueryBuilder(): QueryBuilder
    {
        $request = $this->requestStack->getCurrentRequest() ?? new Request();

        return $this->createQueryBuilder('book')
            ->where('books.publish = true')
            ->leftJoin('books.translations', 'translations', Join::WITH, 'translations.locale = :locale')
            ->setParameter('locale', $request->getLocale());
    }
}
