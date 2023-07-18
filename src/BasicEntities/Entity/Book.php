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

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Runroom\SamplesBundle\BasicEntities\Repository\BookRepository;
use Runroom\SortableBehaviorBundle\Behaviors\Sortable;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table]
#[ORM\Index(columns: ['publish'])]
#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book implements TranslatableInterface, \Stringable
{
    use Sortable;
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'books')]
    #[ORM\JoinColumn(referencedColumnName: 'id')]
    #[Assert\Valid]
    #[Gedmo\SortableGroup]
    private ?Category $category = null;

    #[Assert\Valid]
    private ?MediaInterface $picture = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $publish = null;

    public function __toString(): string
    {
        return (string) $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setPicture(?MediaInterface $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPicture(): ?MediaInterface
    {
        return $this->picture;
    }

    public function setPublish(?bool $publish): self
    {
        $this->publish = $publish;

        return $this;
    }

    public function getPublish(): ?bool
    {
        return $this->publish;
    }

    public function getTitle(?string $locale = null): ?string
    {
        return $this->translate($locale, false)->getTitle();
    }

    public function getSlug(?string $locale = null): ?string
    {
        return $this->translate($locale, false)->getSlug();
    }

    public function getDescription(?string $locale = null): ?string
    {
        return $this->translate($locale, false)->getDescription();
    }
}
