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

use Runroom\RenderEventBundle\Renderer\PageRendererInterface;
use Runroom\SamplesBundle\Forms\Service\ContactService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * This class shows how to use the PageRendererInterface, it is not using AbstractController on purpose.
 */
final class ContactController
{
    public function __construct(
        private PageRendererInterface $renderer,
        private UrlGeneratorInterface $router,
        private ContactService $service
    ) {
    }

    public function contact(): Response
    {
        $model = $this->service->getContactForm();

        if ($model->formIsValid()) {
            return new RedirectResponse(
                $this->router->generate('runroom_samples.forms.contact', ['_fragment' => 'form'])
            );
        }

        return $this->renderer->renderResponse('@RunroomSamples/Forms/contact.html.twig', $model);
    }

    public function contactAjax(): Response
    {
        return $this->renderer->renderResponse(
            '@RunroomSamples/Forms/contact-ajax.html.twig',
            $this->service->getContactForm()
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
                $this->router->generate('runroom_samples.forms.hubspot', ['_fragment' => 'form'])
            );
        }

        return $this->renderer->renderResponse('@RunroomSamples/Forms/contact-hubspot.html.twig', $model);
    }
}
