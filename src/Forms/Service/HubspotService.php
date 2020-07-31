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

use SevenShores\Hubspot\Resources\Forms;

class HubspotService
{
    /** @var Forms */
    protected $hubspotForms;

    /** @var string */
    protected $portalId;

    /** @var string */
    protected $formId;

    public function __construct(
        Forms $hubspotForms,
        string $portalId,
        string $formId
    ) {
        $this->hubspotForms = $hubspotForms;
        $this->portalId = $portalId;
        $this->formId = $formId;
    }

    public function send(iterable $data): void
    {
        $this->hubspotForms->submit($this->portalId, $this->formId, $data);
    }
}
