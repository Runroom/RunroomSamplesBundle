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
use PHPUnit\Framework\TestCase;
use Runroom\FormHandlerBundle\FormHandler;
use Runroom\FormHandlerBundle\ViewModel\FormAwareInterface;
use Runroom\SamplesBundle\Forms\Form\Type\ContactFormType;
use Runroom\SamplesBundle\Forms\Form\Type\ContactHubspotFormType;
use Runroom\SamplesBundle\Forms\Service\ContactService;

class ContactServiceTest extends TestCase
{
    /** @var MockObject&FormHandler */
    private $handler;

    private ContactService $service;

    protected function setUp(): void
    {
        $this->handler = $this->createMock(FormHandler::class);

        $this->service = new ContactService(
            $this->handler
        );
    }

    /** @test */
    public function itGeneratesDemoViewModel(): void
    {
        $formAware = $this->createStub(FormAwareInterface::class);

        $this->handler->method('handleForm')->with(ContactFormType::class)->willReturn($formAware);

        $model = $this->service->getContactForm();

        self::assertSame($formAware, $model);
    }

    /** @test */
    public function itGeneratesDemoHubspotViewModel(): void
    {
        $formAware = $this->createStub(FormAwareInterface::class);

        $this->handler->method('handleForm')->with(ContactHubspotFormType::class)->willReturn($formAware);

        $model = $this->service->getContactHubspotForm();

        self::assertSame($formAware, $model);
    }
}
