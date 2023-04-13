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

namespace Runroom\SamplesBundle\Forms\Service;

use Runroom\FormHandlerBundle\FormHandler;
use Runroom\FormHandlerBundle\ViewModel\FormAwareInterface;
use Runroom\SamplesBundle\Forms\Form\Type\ContactFormType;
use Runroom\SamplesBundle\Forms\Form\Type\ContactHubspotFormType;

class ContactService
{
    public function __construct(private FormHandler $handler)
    {
    }

    public function getContactForm(): FormAwareInterface
    {
        return $this->handler->handleForm(ContactFormType::class);
    }

    public function getContactHubspotForm(): FormAwareInterface
    {
        return $this->handler->handleForm(ContactHubspotFormType::class);
    }
}
