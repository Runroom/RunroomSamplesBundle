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

class BookViewModel
{
    public function __construct(private readonly Book $book) {}

    public function getBook(): Book
    {
        return $this->book;
    }
}
