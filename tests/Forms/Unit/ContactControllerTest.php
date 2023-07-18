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

namespace Runroom\SamplesBundle\Tests\Forms\Unit;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Runroom\FormHandlerBundle\ViewModel\FormAwareInterface;
use Runroom\RenderEventBundle\Renderer\PageRendererInterface;
use Runroom\SamplesBundle\Forms\Controller\ContactController;
use Runroom\SamplesBundle\Forms\Service\ContactService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ContactControllerTest extends TestCase
{
    private MockObject&PageRendererInterface $renderer;
    private Stub&ContactService $service;
    private ContactController $controller;

    protected function setUp(): void
    {
        $this->renderer = $this->createMock(PageRendererInterface::class);
        $this->service = $this->createStub(ContactService::class);

        $this->controller = new ContactController(
            $this->renderer,
            $this->createStub(UrlGeneratorInterface::class),
            $this->service,
        );
    }

    public function testItRendersContact(): void
    {
        $expectedResponse = new Response();

        $model = $this->createStub(FormAwareInterface::class);

        $model->method('formIsValid')->willReturn(false);

        $this->service->method('getContactForm')->willReturn($model);
        $this->renderer->method('renderResponse')->with('@RunroomSamples/Forms/contact.html.twig', $model, null)
            ->willReturn($expectedResponse);

        $response = $this->controller->contact();

        static::assertSame($expectedResponse, $response);
    }

    public function testItRendersContactAjax(): void
    {
        $expectedResponse = new Response();

        $model = $this->createStub(FormAwareInterface::class);

        $this->service->method('getContactForm')->willReturn($model);
        $this->renderer->method('renderResponse')->with('@RunroomSamples/Forms/contact-ajax.html.twig', $model, null)
            ->willReturn($expectedResponse);

        $response = $this->controller->contactAjax();

        static::assertSame($expectedResponse, $response);
    }

    public function testItProcessesAjaxFormValid(): void
    {
        $model = $this->createStub(FormAwareInterface::class);

        $this->service->method('getContactForm')->willReturn($model);

        $model->method('formIsValid')->willReturn(true);

        $response = $this->controller->contactAjaxPost();

        static::assertSame(Response::HTTP_OK, $response->getStatusCode());
        static::assertSame(json_encode(['status' => 'ok']), $response->getContent());
    }

    public function testItProcessesAjaxFormError(): void
    {
        $model = $this->createStub(FormAwareInterface::class);

        $this->service->method('getContactForm')->willReturn($model);

        $model->method('formIsValid')->willReturn(false);

        $response = $this->controller->contactAjaxPost();

        static::assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        static::assertSame(json_encode(['status' => 'error']), $response->getContent());
    }

    public function testItRendersContactHubspot(): void
    {
        $expectedResponse = new Response();

        $model = $this->createStub(FormAwareInterface::class);

        $model->method('formIsValid')->willReturn(false);

        $this->service->method('getContactHubspotForm')->willReturn($model);
        $this->renderer->method('renderResponse')->with('@RunroomSamples/Forms/contact-hubspot.html.twig', $model, null)
            ->willReturn($expectedResponse);

        $response = $this->controller->contactHubspot();

        static::assertSame($expectedResponse, $response);
    }
}
