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

namespace Runroom\SamplesBundle\Forms\Form;

use Doctrine\ORM\EntityManagerInterface;
use Runroom\FormHandlerBundle\ViewModel\FormAwareInterface;
use Runroom\SamplesBundle\Forms\Entity\Contact;
use Runroom\SamplesBundle\Forms\Service\HubspotService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class ContactHubspotEventHandler implements EventSubscriberInterface
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var HubspotService */
    protected $hubspotService;

    public function __construct(
        EntityManagerInterface $entityManager,
        HubspotService $hubspotService
    )
    {
        $this->entityManager = $entityManager;
        $this->hubspotService = $hubspotService;
    }

    /**
     * @phpstan-param GenericEvent<FormAwareInterface> $event
     * @psalm-param GenericEvent $event
     */
    public function onContactSuccess(GenericEvent $event): void
    {
        $model = $event->getSubject()->getForm()->getData();

        $contact = new Contact();
        $contact->setName($model->getName());
        $contact->setEmail($model->getEmail());
        $contact->setPhone($model->getPhone());
        $contact->setSubject($model->getSubject());
        $contact->setType($model->getType());
        $contact->setPreferences($model->getPreferences());
        $contact->setComment($model->getComment());
        $contact->setNewsletter($model->getNewsletter());
        $contact->setPrivacyPolicy($model->getPrivacyPolicy());

        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        $this->hubspotService->send($model);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'form.contact_hubspot_form.event.success' => 'onContactSuccess',
        ];
    }
}
