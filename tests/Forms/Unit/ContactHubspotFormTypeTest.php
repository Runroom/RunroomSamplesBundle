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

use Runroom\SamplesBundle\Forms\Form\Type\ContactHubspotFormType;
use Runroom\SamplesBundle\Forms\Model\ContactHubspot;
use Symfony\Component\Form\AbstractExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Constraints\Cascade;
use Symfony\Component\Validator\Validation;

class ContactHubspotFormTypeTest extends TypeTestCase
{
    /**
     * @test
     */
    public function submitValidData(): void
    {
        $model = new ContactHubspot();
        $form = $this->factory->create(ContactHubspotFormType::class, $model);
        $form->submit([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '123456789',
            'comment' => 'Lorem ipsum',
            'privacyPolicy' => true,
        ]);
        static::assertTrue($form->isSynchronized());
        static::assertInstanceOf(ContactHubspot::class, $form->getData());
        static::assertSame('John Doe', $model->getName());
        static::assertSame('johndoe@example.com', $model->getEmail());
        static::assertSame('123456789', $model->getPhone());
        static::assertSame('Lorem ipsum', $model->getComment());
        static::assertTrue($model->getPrivacyPolicy());
    }

    /**
     * @psalm-suppress TooManyArguments
     *
     * @return AbstractExtension[]
     */
    protected function getExtensions(): array
    {
        $validatorBuilder = Validation::createValidatorBuilder();

        /**
         * @todo: Simplify this when dropping support for Symfony 4.4
         */
        if (class_exists(Cascade::class)) {
            $validatorBuilder->enableAnnotationMapping(true);
        } else {
            $validatorBuilder->enableAnnotationMapping();
        }

        return [new ValidatorExtension($validatorBuilder->getValidator())];
    }
}
