RunroomSamplesBundle
====================

[![Latest Stable Version](https://poser.pugx.org/runroom/samples-bundle/v/stable)](https://packagist.org/packages/runroom/samples-bundle)
[![Latest Unstable Version](https://poser.pugx.org/runroom/samples-bundle/v/unstable)](https://packagist.org/packages/runroom/samples-bundle)
[![License](https://poser.pugx.org/runroom/samples-bundle/license)](https://packagist.org/packages/runroom/samples-bundle)

[![Total Downloads](https://poser.pugx.org/runroom/samples-bundle/downloads)](https://packagist.org/packages/runroom/samples-bundle)
[![Monthly Downloads](https://poser.pugx.org/runroom/samples-bundle/d/monthly)](https://packagist.org/packages/runroom/samples-bundle)
[![Daily Downloads](https://poser.pugx.org/runroom/samples-bundle/d/daily)](https://packagist.org/packages/runroom/samples-bundle)

[![CI](https://github.com/Runroom/RunroomSamplesBundle/actions/workflows/ci.yaml/badge.svg)](https://github.com/Runroom/RunroomSamplesBundle/actions/workflows/ci.yaml)
[![QA](https://github.com/Runroom/RunroomSamplesBundle/actions/workflows/qa.yaml/badge.svg)](https://github.com/Runroom/RunroomSamplesBundle/actions/workflows/qa.yaml)
[![codecov](https://codecov.io/gh/Runroom/RunroomSamplesBundle/branch/master/graph/badge.svg)](https://codecov.io/gh/Runroom/RunroomSamplesBundle)
[![shepherd](https://shepherd.dev/github/Runroom/RunroomSamplesBundle/coverage.svg)](https://shepherd.dev/github/Runroom/RunroomSamplesBundle)

This bundle is a collection of samples that we often need to implement in our projects. Currently this project is not usable outside the [ArchetypeSymfony](https://github.com/Runroom/archetype-symfony)

## Installation

Open a command console, enter your project directory and execute the following command to download the latest stable version of this bundle:

```
composer require runroom/samples-bundle
```

### Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles in `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Runroom\SamplesBundle\RunroomSamplesBundle::class => ['all' => true],
];
```

### Update doctrine schema

Finally, execute doctrine schema update to create the new tables:

```
console doctrine:schema:update --force
```

## License

This bundle is under the [MIT license](LICENSE).
