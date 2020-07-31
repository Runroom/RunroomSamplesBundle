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

namespace Runroom\SamplesBundle\BasicEntities\ElasticSearch;

use Elastica\Document;
use Runroom\SamplesBundle\BasicEntities\ElasticSearch\PropertyBuilder\AbstractBuilder;
use Runroom\SamplesBundle\BasicEntities\Entity\Book;
use Runroom\SamplesBundle\BasicEntities\Entity\BookTranslation;

class BookBuilder extends AbstractBuilder
{
    protected function supportedModelClass(object $model): bool
    {
        return $model instanceof Book;
    }

    protected function isIndexable(object $model): bool
    {
        \assert($model instanceof Book);

        return $model->getPublish();
    }

    protected function build(Document $document, object $model): void
    {
        \assert($model instanceof Book);

        /** @var BookTranslation $modelTranslation */
        foreach ($model->getTranslations() as $modelTranslation) {
            $document->set('title_' . $modelTranslation->getLocale(), $modelTranslation->getTitle());
            $document->set('description_' . $modelTranslation->getLocale(), $modelTranslation->getTitle());
        }

        $category = $model->getCategory();

        if ($category) {
            $document->set('category', $category->getId());
        }

        $document->set('position', $model->getPosition());
    }
}
