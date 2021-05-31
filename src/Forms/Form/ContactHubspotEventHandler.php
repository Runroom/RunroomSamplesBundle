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

use Runroom\FormHandlerBundle\ViewModel\FormAwareInterface;
use SevenShores\Hubspot\Resources\Forms;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ContactHubspotEventHandler implements EventSubscriberInterface
{
    private TranslatorInterface $translator;
    private Forms $hubspotForms;
    private int $portalId;
    private string $formId;

    public function __construct(
        TranslatorInterface $translator,
        Forms $hubspotForms,
        int $portalId,
        string $formId
    ) {
        $this->translator = $translator;
        $this->hubspotForms = $hubspotForms;
        $this->portalId = $portalId;
        $this->formId = $formId;
    }

    /**
     * @phpstan-param GenericEvent<FormAwareInterface> $event
     * @psalm-param GenericEvent $event
     */
    public function onContactSuccess(GenericEvent $event): void
    {
        $model = $event->getSubject()->getForm()->getData();

        $this->sendHubspot([
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
            ],
            'legalConsentOptions' => [
                'consent' => [
                    'text' => $this->translator->trans('form.privacy_policy', [], 'messages', 'es'),
                    'consentToProcess' => $model->getPrivacyPolicy(),
                ],
            ],
        ]);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'form.contact_hubspot_form.event.success' => 'onContactSuccess',
        ];
    }

    /** @param array{ fields: array{name: string, value: mixed}[], legalConsentOptions: array{consent: array{consentToProcess: mixed, text: string} } } $data */
    private function sendHubspot(array $data): void
    {
        $this->hubspotForms->submit($this->portalId, $this->formId, $data);
    }
}
