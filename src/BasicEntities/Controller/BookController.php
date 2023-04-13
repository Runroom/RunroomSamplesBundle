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

namespace Runroom\SamplesBundle\BasicEntities\Controller;

use Runroom\SamplesBundle\BasicEntities\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookController extends AbstractController
{
    public function __construct(private BookService $service)
    {
    }

    public function books(): Response
    {
        return $this->render('@RunroomSamples/BasicEntities/books.html.twig', [
            'model' => $this->service->getBooksViewModel(),
        ]);
    }

    public function book(string $slug): Response
    {
        return $this->render('@RunroomSamples/BasicEntities/book.html.twig', [
            'model' => $this->service->getBookViewModel($slug),
        ]);
    }
}
