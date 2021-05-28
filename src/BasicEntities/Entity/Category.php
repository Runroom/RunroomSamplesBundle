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

namespace Runroom\SamplesBundle\BasicEntities\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/** @ORM\Entity */
class Category implements TranslatableInterface
{
    use ORMBehaviors\Translatable\TranslatableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var Collection<int, Book>
     *
     * @ORM\OneToMany(targetEntity="Book", mappedBy="category")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(string $locale = null): ?string
    {
        return $this->translate($locale, false)->getName();
    }

    public function addBook(Book $book): self
    {
        $this->books[] = $book;

        return $this;
    }

    public function removeBook(Book $book): void
    {
        $this->books->removeElement($book);
    }

    /** @param Collection<int, Book> $books */
    public function setBooks(Collection $books): self
    {
        $this->books = $books;

        return $this;
    }

    /** @return Collection<int, Book> */
    public function getBooks(): Collection
    {
        return $this->books;
    }
}
