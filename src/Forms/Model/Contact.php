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

namespace Runroom\SamplesBundle\Forms\Model;

use Runroom\SamplesBundle\Forms\Entity\Contact as EntityContact;

class Contact
{
    private ?string $name = null;
    private ?string $email = null;
    private ?string $phone = null;
    private ?int $subject = EntityContact::SUBJECT_GENERAL;
    private ?int $type = null;

    /**
     * @var int[]|null
     */
    private ?array $preferences = [];
    private ?string $comment = null;
    private ?bool $newsletter = null;
    private ?bool $privacyPolicy = null;

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
}
