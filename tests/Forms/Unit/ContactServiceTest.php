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
use Runroom\FormHandlerBundle\FormHandler;
use Runroom\FormHandlerBundle\ViewModel\FormAwareInterface;
use Runroom\SamplesBundle\Forms\Form\Type\ContactFormType;
use Runroom\SamplesBundle\Forms\Form\Type\ContactHubspotFormType;
use Runroom\SamplesBundle\Forms\Service\ContactService;

class ContactServiceTest extends TestCase
{
    use ProphecyTrait;

    /** @var ObjectProphecy<FormHandler> */
    private $handler;

    /** @var ContactService */
    private $service;

    protected function setUp(): void
    {
        $this->handler = $this->prophesize(FormHandler::class);

        $this->service = new ContactService(
            $this->handler->reveal()
        );
    }

    /** @test */
    public function itGeneratesDemoViewModel(): void
    {
        $formAware = $this->prophesize(FormAwareInterface::class);

        $this->handler->handleForm(ContactFormType::class)->willReturn($formAware->reveal());

        $model = $this->service->getContactForm();

        self::assertSame($formAware->reveal(), $model);
    }

    /** @test */
    public function itGeneratesDemoHubspotViewModel(): void
    {
        $formAware = $this->prophesize(FormAwareInterface::class);

        $this->handler->handleForm(ContactHubspotFormType::class)->willReturn($formAware->reveal());

        $model = $this->service->getContactHubspotForm();

        self::assertSame($formAware->reveal(), $model);
    }
}
