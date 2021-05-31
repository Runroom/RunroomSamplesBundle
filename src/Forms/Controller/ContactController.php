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

namespace Runroom\SamplesBundle\Forms\Controller;

use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Runroom\SamplesBundle\Forms\Service\ContactService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ContactController
{
    private PageRenderer $renderer;
    private UrlGeneratorInterface $router;
    private ContactService $service;

    public function __construct(
        PageRenderer $renderer,
        UrlGeneratorInterface $router,
        ContactService $service
    ) {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->service = $service;
    }

    public function contact(): Response
    {
        $model = $this->service->getContactForm();

        if ($model->formIsValid()) {
            return new RedirectResponse(
                $this->router->generate('runroom_samples.forms.contact', [
                    '_fragment' => 'form',
                ])
            );
        }

        return $this->renderer->renderResponse(
            '@RunroomSamples/Forms/contact.html.twig',
            $model
        );
    }

    public function contactAjax(): Response
    {
        $model = $this->service->getContactForm();

        return $this->renderer->renderResponse(
            '@RunroomSamples/Forms/contact-ajax.html.twig',
            $model
        );
    }

    public function contactAjaxPost(): JsonResponse
    {
        $model = $this->service->getContactForm();

        if ($model->formIsValid()) {
            return new JsonResponse(['status' => 'ok']);
        }

        return new JsonResponse(['status' => 'error'], Response::HTTP_BAD_REQUEST);
    }

    public function contactHubspot(): Response
    {
        $model = $this->service->getContactHubspotForm();

        if ($model->formIsValid()) {
            return new RedirectResponse(
                $this->router->generate('runroom_samples.forms.hubspot', [
                    '_fragment' => 'form',
                ])
            );
        }

        return $this->renderer->renderResponse(
            '@RunroomSamples/Forms/contact-hubspot.html.twig',
            $model
        );
    }
}
