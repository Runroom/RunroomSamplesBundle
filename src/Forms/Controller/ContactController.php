<?php

declare(strict_types=1);

/*
 * This file is part of the SamplesBundle.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SamplesBundle\Forms\Controller;

use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Runroom\SamplesBundle\Core\Service\FormHandler;
use Runroom\SamplesBundle\Forms\Service\ContactService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ContactController
{
    protected $renderer;
    protected $router;
    protected $service;
    protected $formHandler;

    public function __construct(
        PageRenderer $renderer,
        UrlGeneratorInterface $router,
        ContactService $service,
        FormHandler $formHandler
    ) {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->service = $service;
        $this->formHandler = $formHandler;
    }

    public function normalForm(): Response
    {
        $model = $this->service->getContactForm();

        if ($model->getIsSuccess()) {
            return new RedirectResponse(
                $this->router->generate('archetype.demo.route.demo', [
                    '_fragment' => 'form',
                ])
            );
        }

        return $this->renderer->renderResponse(
            '@SamplesBundle/Forms/normal-form.html.twig',
            $model
        );
    }

    public function ajaxForm(): Response
    {
        $model = $this->service->getContactForm();

        return $this->renderer->renderResponse(
            '@SamplesBundle/Forms/ajax-form.html.twig',
            $model
        );
    }

    public function ajaxPostForm(): JsonResponse
    {
        $model = $this->service->getContactForm();

        if ($model->getIsSuccess()) {
            return new JsonResponse(['status' => 'ok']);
        }

        return new JsonResponse(['status' => 'error'], Response::HTTP_BAD_REQUEST);
    }
}
