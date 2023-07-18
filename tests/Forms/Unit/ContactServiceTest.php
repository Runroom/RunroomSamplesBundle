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
use Runroom\FormHandlerBundle\FormHandlerInterface;
use Runroom\FormHandlerBundle\ViewModel\FormAwareInterface;
use Runroom\SamplesBundle\Forms\Form\Type\ContactFormType;
use Runroom\SamplesBundle\Forms\Form\Type\ContactHubspotFormType;
use Runroom\SamplesBundle\Forms\Service\ContactService;

class ContactServiceTest extends TestCase
{
    private MockObject&FormHandlerInterface $handler;
    private ContactService $service;

    protected function setUp(): void
    {
        $this->handler = $this->createMock(FormHandlerInterface::class);

        $this->service = new ContactService(
            $this->handler
        );
    }

    public function testItGeneratesDemoViewModel(): void
    {
        $formAware = $this->createStub(FormAwareInterface::class);

        $this->handler->method('handleForm')->with(ContactFormType::class)->willReturn($formAware);

        $model = $this->service->getContactForm();

        static::assertSame($formAware, $model);
    }

    public function testItGeneratesDemoHubspotViewModel(): void
    {
        $formAware = $this->createStub(FormAwareInterface::class);

        $this->handler->method('handleForm')->with(ContactHubspotFormType::class)->willReturn($formAware);

        $model = $this->service->getContactHubspotForm();

        static::assertSame($formAware, $model);
    }
}
