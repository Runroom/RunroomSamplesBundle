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
use Runroom\SamplesBundle\Forms\Model\ContactHubspot;
use SevenShores\Hubspot\Endpoints\Forms;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ContactHubspotEventHandler implements EventSubscriberInterface
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly Forms $hubspotForms,
        private readonly int $portalId,
        private readonly string $formId,
    ) {}

    /**
     * @phpstan-param GenericEvent<FormAwareInterface> $event
     * @psalm-param GenericEvent $event
     */
    public function onContactSuccess(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        \assert($subject instanceof FormAwareInterface);

        $form = $subject->getForm();
        \assert(null !== $form);

        $model = $form->getData();
        \assert($model instanceof ContactHubspot);

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
        return ['form.contact_hubspot_form.event.success' => 'onContactSuccess'];
    }

    /**
     * @param array{ fields: array{name: string, value: mixed}[], legalConsentOptions: array{consent: array{consentToProcess: mixed, text: string} } } $data
     */
    private function sendHubspot(array $data): void
    {
        $this->hubspotForms->submit($this->portalId, $this->formId, $data);
    }
}
