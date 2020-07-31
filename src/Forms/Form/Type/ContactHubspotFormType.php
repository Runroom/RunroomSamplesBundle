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

use Runroom\SamplesBundle\Forms\Model\ContactHubspot;
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

class ContactHubspotFormType extends AbstractType
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
            ->add('comment', TextareaType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'not_blank']),
                ],
            ])
            ->add('privacyPolicy', CheckboxType::class, [
                'constraints' => [
                    new Assert\IsTrue(['message' => 'privacy_policy']),
                ],
            ])
            ->add('send', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactHubspot::class,
            'csrf_protection' => false,
        ]);
    }
}
