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

namespace Runroom\SamplesBundle\Forms\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Contact implements \Stringable
{
    public const SUBJECT_GENERAL = 1;
    private const SUBJECT_SPECIFIC = 2;

    private const STATUS_UNREAD = 1;
    private const STATUS_READ = 2;
    private const STATUS_PROCESSED = 3;

    private const TYPE_COMMENT = 1;
    private const TYPE_BUG = 2;

    private const PREFERENCE_DESIGN = 1;
    private const PREFERENCE_BACKEND = 2;
    private const PREFERENCE_FRONTEND = 3;
    private const PREFERENCE_MARKETING = 4;

    /**
     * @var array<string, int>
     */
    public static array $subjectChoices = [
        'form.subject.general' => self::SUBJECT_GENERAL,
        'form.subject.specific' => self::SUBJECT_SPECIFIC,
    ];

    /**
     * @var array<string, int>
     */
    public static array $statusChoices = [
        'contact.status.unread' => self::STATUS_UNREAD,
        'contact.status.read' => self::STATUS_READ,
        'contact.status.processed' => self::STATUS_PROCESSED,
    ];

    /**
     * @var array<string, int>
     */
    public static array $typeChoices = [
        'form.type.comment' => self::TYPE_COMMENT,
        'form.type.bug' => self::TYPE_BUG,
    ];

    /**
     * @var array<string, int>
     */
    public static array $preferenceChoices = [
        'form.preference.design' => self::PREFERENCE_DESIGN,
        'form.preference.backend' => self::PREFERENCE_BACKEND,
        'form.preference.frontend' => self::PREFERENCE_FRONTEND,
        'form.preference.marketing' => self::PREFERENCE_MARKETING,
    ];

    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $phone = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $subject = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $type = null;

    /**
     * @var int[]|null
     *
     * @ORM\Column(type="array")
     */
    private ?array $preferences = null;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $comment = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $newsletter = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $privacyPolicy = null;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $date = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $status = self::STATUS_UNREAD;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSubject(): ?int
    {
        return $this->subject;
    }

    public function setSubject(?int $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int[]|null
     */
    public function getPreferences(): ?array
    {
        return $this->preferences;
    }

    /**
     * @param int[]|null $preferences
     */
    public function setPreferences(?array $preferences): self
    {
        $this->preferences = $preferences;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(?bool $newsletter): self
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getPrivacyPolicy(): ?bool
    {
        return $this->privacyPolicy;
    }

    public function setPrivacyPolicy(?bool $privacyPolicy): self
    {
        $this->privacyPolicy = $privacyPolicy;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
