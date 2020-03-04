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

namespace Runroom\SamplesBundle\Forms\Service;

use Runroom\SamplesBundle\Core\Service\FormHandler;
use Runroom\SamplesBundle\Core\ViewModel\FormAwareInterface;
use Runroom\SamplesBundle\Forms\Form\Type\ContactFormType;

class ContactService
{
    protected $handler;

    public function __construct(FormHandler $handler)
    {
        $this->handler = $handler;
    }

    public function getContactForm(): FormAwareInterface
    {
        return $this->handler->handleForm(ContactFormType::class);
    }
}
