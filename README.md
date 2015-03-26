# Wunderlist PHP SDK

[![Build Status](https://travis-ci.org/italolelis/wunderlist.svg?style=flat-square)](https://travis-ci.org/italolelis/wunderlist)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/italolelis/wunderlist.svg?style=flat-square)](https://scrutinizer-ci.com/g/italolelis/wunderlist/)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/italolelis/wunderlist.svg?style=flat-square)](https://scrutinizer-ci.com/g/italolelis/wunderlist/)
[![Latest Stable Version](http://img.shields.io/packagist/v/italolelis/wunderlist.svg?style=flat-square)](https://packagist.org/packages/italolelis/wunderlist)
[![Downloads](https://img.shields.io/packagist/dt/italolelis/wunderlist.svg?style=flat-square)](https://packagist.org/packages/italolelis/wunderlist)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/1f67b9bd-f120-43d5-9f02-f73aa6132d86/small.png)](https://insight.sensiolabs.com/projects/1f67b9bd-f120-43d5-9f02-f73aa6132d86)

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
$wunderlist = new \Wunderlist\Wunderlist([
    'clientId' => 'yourClientId',
    'clientSecret' => 'yourClientSecret',
    'redirectUri' => 'http://yourhost.com/wunderlist/callback'
]);

//Here we get the lists service, we did not get the lists yet
$listsService = $wunderlist->getLists();

//Here we get all lists for the authenticated user
$listsService->all();
```

What about all taks for a list?

```php
$tasksService = $wunderlist->getTasks();

//Here we get all lists for the authenticated user
$lists = $listsService->all();

//For each list on the lists
foreach($lists as $list) {
    $tasks = $tasksService->forList($list);
}

```

Ok, now lets create a task for a list

```php
$tasksService = $wunderlist->getTasks();

//Here we get all lists for the authenticated user
$lists = $listsService->all();

//We get the first list
$list = $lists->first();

$task = new \Wunderlist\Entity\Task();
$task
    ->setListID($list->getId())
    ->setTitle('Test Hello');

$tasksService->create($task);
```

This is just some simple things you can do with the SDK. Whant more? please just read our [documentation](http://wunderlist.readthedocs.org/)
## Contributing

Please see [CONTRIBUTING](https://github.com/LellysInformatica/collections/blob/master/CONTRIBUTING.md) for details.

## Credits

- [italolelis](https://github.com/italolelis)
- [All Contributors](https://github.com/italolelis/wunderlist/contributors)

## License

The MIT License (MIT). Please see [License File](https://github.com/italolelis/wunderlist/blob/master/LICENSE) for more information.

### Documentation

More information can be found in the online documentation at
http://wunderlist.readthedocs.org/.
