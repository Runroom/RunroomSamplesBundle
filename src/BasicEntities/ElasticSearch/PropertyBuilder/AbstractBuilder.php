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

namespace Runroom\SamplesBundle\BasicEntities\ElasticSearch\PropertyBuilder;

use Elastica\Document;
use FOS\ElasticaBundle\Event\TransformEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class AbstractBuilder implements EventSubscriberInterface
{
    protected abstract function supportedModelClass(object $model): bool;
    protected abstract function isIndexable(object $model): bool;
    protected abstract function build(Document $document, object $model): void;

    public function consumeEvent(TransformEvent $event): void
    {
        $model = $event->getObject();
        $supportedClass = $this->supportedModelClass($model);

        if (!$model instanceof $supportedClass || $this->isIndexable($model)) {
            return;
        }

        $this->build($event->getDocument(), $model);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            TransformEvent::POST_TRANSFORM => 'consumeEvent',
        ];
    }
}
