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

namespace Runroom\SamplesBundle\Tests\BasicEntities\Fixtures;

use Runroom\SamplesBundle\BasicEntities\Entity\Book;

class BookFixture
{
    protected const TITLE = 'title';
    protected const DESCRIPTION = 'description';
    protected const POSITION = 0;

    public static function create(): Book
    {
        $category = CategoryFixture::create();

        $book = new Book();
        $book->translate()->setTitle(self::TITLE);
        $book->translate()->setDescription(self::DESCRIPTION);
        $book->setPosition(self::POSITION);
        $book->setCategory($category);

        // $picture = new Media();
        // $book->setPicture($picture);

        $category->addBook($book);

        return $book;
    }
}
