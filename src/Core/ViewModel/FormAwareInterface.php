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

namespace Runroom\SamplesBundle\Core\ViewModel;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

interface FormAwareInterface
{
    public function setForm(FormInterface $form): void;

    public function getForm(): FormInterface;

    public function setIsSuccess(bool $isSuccess): void;

    public function getIsSuccess(): bool;

    public function getFormView(): FormView;

    public function formIsValid(): bool;
}
