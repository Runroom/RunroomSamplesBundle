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
    public function __construct(
        ManagerRegistry $registry,
        private readonly RequestStack $requestStack,
    ) {
        parent::__construct($registry, Book::class);
    }

    public function findBySlug(string $slug): Book
    {
        $request = $this->requestStack->getCurrentRequest() ?? new Request();

        $query = $this->createQueryBuilder('book')
            ->leftJoin('book.translations', 'translations')
            ->where('translations.locale = :locale')
            ->andWhere('translations.slug = :slug')
            ->andWhere('book.publish = true')
            ->setParameter('slug', $slug)
            ->setParameter('locale', $request->getLocale())
            ->getQuery();

        $book = $query->getSingleResult();
        \assert($book instanceof Book);

        return $book;
    }
}
