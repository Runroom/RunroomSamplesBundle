<?php

declare(strict_types=1);

/*
 * This file is part of the SamplesBundle.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SamplesBundle\BasicEntities\ViewModel;

class BooksViewModel
{
    protected $books;

    public function setBooks(array $books): void
    {
        $this->books = $books;
    }

    public function getBooks(): ?array
    {
        return $this->books;
    }
}
