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

namespace Runroom\SamplesBundle\BasicEntities\ViewModel;

use Runroom\SamplesBundle\BasicEntities\Entity\Book;

class BooksViewModel
{
    /** @var Book[] */
    private $books;

    /** @param Book[] $books */
    public function setBooks(array $books): void
    {
        $this->books = $books;
    }

    /** @return Book[]|null */
    public function getBooks(): ?array
    {
        return $this->books;
    }
}