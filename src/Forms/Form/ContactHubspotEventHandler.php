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
use Runroom\SamplesBundle\Forms\Service\HubspotService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Translation\TranslatorInterface;

class ContactHubspotEventHandler implements EventSubscriberInterface
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var TranslatorInterface */
    protected $translator;

    /** @var HubspotService */
    protected $hubspotService;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslatorInterface $translator,
        HubspotService $hubspotService
    )
    {
        $this->entityManager = $entityManager;
        $this->translator = $translator;
        $this->hubspotService = $hubspotService;
    }

    /**
     * @phpstan-param GenericEvent<FormAwareInterface> $event
     * @psalm-param GenericEvent $event
     */
    public function onContactSuccess(GenericEvent $event): void
    {
        $model = $event->getSubject()->getForm()->getData();

        $data = [
            'fields' => [
                [
                    'name' => 'firstname',
                    'value' => $model->getName(),
                ],
                [
                    'name' => 'phone',
                    'value' => $model->getPhone(),
                ],
                [
                    'name' => 'email',
                    'value' => $model->getEmail(),
                ],
                [
                    'name' => 'comentario',
                    'value' => $model->getComment(),
                ],
                [
                    'name' => 'comentario',
                    'value' => $model->getComment(),
                ],
            ],
            'legalConsentOptions' => [
                'consent' => [
                    'text' => $this->translator->trans('form.privacy_policy', [], 'messages','es'),
                    'consentToProcess' => $model->getPrivacyPolicy(),
                ],
            ]
        ];
        $this->hubspotService->send($data);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'form.contact_hubspot_form.event.success' => 'onContactSuccess',
        ];
    }
}
