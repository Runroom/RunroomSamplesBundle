<?php


namespace Runroom\SamplesBundle\Tests\Forms\Unit;

use Runroom\SamplesBundle\Forms\Form\Type\ContactHubspotFormType;
use Runroom\SamplesBundle\Forms\Model\ContactHubspot;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Validator\Validation;

class ContactHubspotFormTypeTest extends TypeTestCase
{
    protected function getExtensions()
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        return [
            new ValidatorExtension($validator),
        ];
    }

    public function testSubmitValidData()
    {
        $formData = [
            'name' => null,
            'email' => null,
            'phone' => null,
            'comment' => null,
            'privacyPolicy' => false,
        ];

        $model = new ContactHubspot();
        $form = $this->factory->create(ContactHubspotFormType::class, $model);
        $expected = new ContactHubspot();
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $model);
    }
}
