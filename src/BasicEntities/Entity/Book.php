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

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Runroom\SamplesBundle\BasicEntities\Repository\BookRepository;
use Runroom\SortableBehaviorBundle\Behaviors\Sortable;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 * @ORM\Table(indexes={
 *     @ORM\Index(columns={"publish"}),
 * })
 */
class Book implements TranslatableInterface
{
    use ORMBehaviors\Translatable\TranslatableTrait;
    use Sortable;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Category|null
     *
     * @Assert\Valid
     * @Gedmo\SortableGroup
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="books")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $category;

    /**
     * @var MediaInterface|null
     *
     * @Assert\Valid
     */
    private $picture;

    /**
     * @var bool|null
     *
     * @ORM\Column(type="boolean")
     */
    private $publish;

    public function __toString(): string
    {
        return (string) $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(string $locale = null): ?string
    {
        return $this->translate($locale, false)->getTitle();
    }

    public function getSlug(string $locale = null): ?string
    {
        return $this->translate($locale, false)->getSlug();
    }

    public function getDescription(string $locale = null): ?string
    {
        return $this->translate($locale, false)->getDescription();
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
}
