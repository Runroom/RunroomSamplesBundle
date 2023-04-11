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

namespace Runroom\SamplesBundle\Forms\Form\Type;

use Runroom\SamplesBundle\Forms\Entity\Contact as EntityContact;
use Runroom\SamplesBundle\Forms\Model\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @psalm-suppress MissingTemplateParam
 */
class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'not_blank']),
                    new Assert\Length(['max' => 255, 'maxMessage' => 'max_length']),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Assert\Email(['mode' => 'strict', 'message' => 'email']),
                    new Assert\NotBlank(['message' => 'not_blank']),
                    new Assert\Length(['max' => 255, 'maxMessage' => 'max_length']),
                ],
            ])
            ->add('phone', TelType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'not_blank']),
                    new Assert\Length(['max' => 255, 'maxMessage' => 'max_length']),
                ],
            ])
            ->add('subject', ChoiceType::class, [
                'choices' => EntityContact::$subjectChoices,
                'constraints' => [
                    new Assert\Choice([
                        'choices' => array_values(EntityContact::$subjectChoices),
                        'strict' => true,
                        'message' => 'choices',
                    ]),
                    new Assert\NotBlank(['message' => 'not_blank']),
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => EntityContact::$typeChoices,
                'expanded' => true,
                'constraints' => [
                    new Assert\Choice([
                        'choices' => array_values(EntityContact::$typeChoices),
                        'strict' => true,
                        'message' => 'choices',
                    ]),
                    new Assert\NotBlank(['message' => 'not_blank']),
                ],
            ])
            ->add('preferences', ChoiceType::class, [
                'choices' => EntityContact::$preferenceChoices,
                'expanded' => true,
                'multiple' => true,
                'required' => false,
                'constraints' => [
                    new Assert\Choice([
                        'choices' => array_values(EntityContact::$preferenceChoices),
                        'strict' => true,
                        'multiple' => true,
                        'multipleMessage' => 'choices',
                    ]),
                ],
            ])
            ->add('comment', TextareaType::class, [
                'constraints' => [new Assert\NotBlank(['message' => 'not_blank'])],
            ])
            ->add('newsletter', CheckboxType::class, ['required' => false])
            ->add('privacyPolicy', CheckboxType::class, [
                'constraints' => [new Assert\IsTrue(['message' => 'privacy_policy'])],
            ])
            ->add('send', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'csrf_protection' => false,
        ]);
    }
}
