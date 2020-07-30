<?php


namespace Runroom\SamplesBundle\Forms\Service;

use SevenShores\Hubspot\Resources\Forms;

class HubspotService
{
    protected $hubspotForms;

    public function __construct(
        Forms $hubspotForms
    )
    {
        $this->hubspotForms = $hubspotForms;
    }
    public function send($model)
    {
        $array = [
            'fields' => [
                [
                    'name' => 'firstname',
                    'value' => 'Test',
                ],
                [
                    'name' => 'lastname',
                    'value' => 'Runroom',
                ],
                [
                    'name' => 'email',
                    'value' => 'oscar@runroom.com',
                ],
            ],
        ];
        $this->hubspotForms->submit('4299768', 'f754ad44-75dc-4917-9f48-b2e736f62f52', $array);
    }
}
