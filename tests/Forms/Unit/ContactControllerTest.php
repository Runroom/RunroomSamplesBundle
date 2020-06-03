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

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Runroom\FormHandlerBundle\ViewModel\FormAwareInterface;
use Runroom\RenderEventBundle\Renderer\PageRenderer;
use Runroom\SamplesBundle\Forms\Controller\ContactController;
use Runroom\SamplesBundle\Forms\Service\ContactService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ContactControllerTest extends TestCase
{
    use ProphecyTrait;

    private const INDEX_VIEW = '@RunroomSamples/Forms/contact.html.twig';
    private const AJAX_FORM_VIEW = '@RunroomSamples/Forms/contact-ajax.html.twig';

    /** @var ObjectProphecy<PageRenderer> */
    private $renderer;

    /** @var ObjectProphecy<UrlGeneratorInterface> */
    private $router;

    /** @var ObjectProphecy<ContactService> */
    private $service;

    /** @var ContactController */
    private $controller;

    protected function setUp(): void
    {
        $this->renderer = $this->prophesize(PageRenderer::class);
        $this->router = $this->prophesize(UrlGeneratorInterface::class);
        $this->service = $this->prophesize(ContactService::class);

        $this->controller = new ContactController(
            $this->renderer->reveal(),
            $this->router->reveal(),
            $this->service->reveal(),
        );
    }

    /** @test */
    public function itRendersContact(): void
    {
        $expectedResponse = new Response();

        $model = $this->prophesize(FormAwareInterface::class);

        $model->formIsValid()->willReturn(false);

        $this->service->getContactForm()->willReturn($model->reveal());
        $this->renderer->renderResponse(self::INDEX_VIEW, $model->reveal(), null)
            ->willReturn($expectedResponse);

        $response = $this->controller->contact();

        $this->assertSame($expectedResponse, $response);
    }

    /** @test */
    public function itRendersContactAjax(): void
    {
        $expectedResponse = new Response();

        $model = $this->prophesize(FormAwareInterface::class);

        $this->service->getContactForm()->willReturn($model->reveal());
        $this->renderer->renderResponse(self::AJAX_FORM_VIEW, $model->reveal(), null)
            ->willReturn($expectedResponse);

        $response = $this->controller->contactAjax();

        $this->assertSame($expectedResponse, $response);
    }

    /** @test */
    public function itProcessesAjaxForm(): void
    {
        $model = $this->prophesize(FormAwareInterface::class);

        $this->service->getContactForm()->willReturn($model);

        $model->formIsValid()->willReturn(true);

        $response = $this->controller->contactAjaxPost();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertSame(json_encode(['status' => 'ok']), $response->getContent());

        $model->formIsValid()->willReturn(false);

        $response = $this->controller->contactAjaxPost();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertSame(json_encode(['status' => 'error']), $response->getContent());
    }
}
