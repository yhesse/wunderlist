# Wunderlist PHP SDK

[![Build Status](https://travis-ci.org/italolelis/wunderlist.svg?style=flat-square)](https://travis-ci.org/italolelis/wunderlist)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/italolelis/wunderlist.svg?style=flat-square)](https://scrutinizer-ci.com/g/italolelis/wunderlist/)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/italolelis/wunderlist.svg?style=flat-square)](https://scrutinizer-ci.com/g/italolelis/wunderlist/)
[![Latest Stable Version](http://img.shields.io/packagist/v/italolelis/wunderlist.svg?style=flat-square)](https://packagist.org/packages/italolelis/wunderlist)
[![Downloads](https://img.shields.io/packagist/dt/italolelis/wunderlist.svg?style=flat-square)](https://packagist.org/packages/italolelis/wunderlist)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/042ad7a7-df3d-4c3f-b93b-558b82d80cee/small.png)](https://insight.sensiolabs.com/projects/042ad7a7-df3d-4c3f-b93b-558b82d80cee)

Unofficial Wunderlist SDK for PHP.
This library works perfectly with Wunderlist v3.

## Install

```bash
composer require italolelis/wunderlist
```

## Usage

### Basic example

The SDK is pretty simple to use, here is an example of how we can access all lists:

```php
<?php

use Wunderlist\Entity\WList;
use Wunderlist\ClientBuilder;

// Instanciate wunderlist API manager
$builder = new ClientBuilder();
$wunderlist = $builder->build('yourClientId', 'yourClientSecret', 'http://domain.com/oauth/callback');

//Here we get all lists for the authenticated user
$lists = $wunderlist->getService(WList::class)->all();

//For each list on the lists
$lists->map(function($list) {
    echo $list->getTitle();
});
    
```

What about all taks for a list?

```php
<?php

use Wunderlist\Entity\Task;
use Wunderlist\Entity\WList;

//Here we get all lists for the authenticated user
$lists = $wunderlist->getService(WList::class)->all();

//For each list on the lists
$lists->map(function($list) {
    $tasks = wunderlist->getService(Task::class)->forList($list);
    $tasks->map(function($task){
        echo $task->getTitle();
    });
});
```

Ok, now lets create a task for a list

```php
use Wunderlist\Entity\WList;
use Wunderlist\Entity\Task;

//Here we get all lists for the authenticated user
$lists = $wunderlist->getService(WList::class)->all();

//We get the first list
$list = $lists->first();

$task = new Task();
$task->setListID($list->getId())
    ->setTitle('Test Hello');

$wunderlist->save($task);
```

This is just some simple things you can do with the SDK. Whant more? please just read our [documentation](http://wunderlist.readthedocs.org/)

## Integrations

 - [Silex service provider](https://github.com/italolelis/wunderlist-provider)
 - [Silex Wunderlist Skeleton](https://github.com/italolelis/silex-wunderlist-skeleton)
 - [Symfony WunderlistBundle](https://github.com/italolelis/wunderlist-bundle)

## Contributing

Please see [CONTRIBUTING](https://github.com/italolelis/wunderlist/blob/master/CONTRIBUTING.md) for details.

## Credits

- [italolelis](https://github.com/italolelis)
- [All Contributors](https://github.com/italolelis/wunderlist/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/italolelis/wunderlist/blob/master/LICENSE) for more information.

### Documentation

More information can be found in the online documentation at
http://wunderlist.readthedocs.org/.
