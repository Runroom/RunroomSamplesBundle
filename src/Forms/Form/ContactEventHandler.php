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
use Runroom\SamplesBundle\Forms\Model\Contact as ModelContact;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class ContactEventHandler implements EventSubscriberInterface
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @phpstan-param GenericEvent<FormAwareInterface> $event
     *
     * @psalm-param GenericEvent $event
     */
    public function onContactSuccess(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        \assert($subject instanceof FormAwareInterface);

        $form = $subject->getForm();
        \assert(null !== $form);

        $model = $form->getData();
        \assert($model instanceof ModelContact);

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
    }

    public static function getSubscribedEvents(): array
    {
        return ['form.contact_form.event.success' => 'onContactSuccess'];
    }
}
