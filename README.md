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

The SDK is pretty simple to use, looks like an javascript client, doesn't it?
That is because all calls to the API are asynchronous, cool hun? 
This creates a *GuzzleHttp\Message\FutureResponse* object that has not yet completed. 
Once you have a future response, you can use a promise object obtained 
by calling the then method of the response to take an action when the response has completed or 
encounters an error.

First we need to configure the credentials:

```php
    $wunderlist = new \Wunderlist\Wunderlist([
        'clientId' => 'yourClientId',
        'clientSecret' => 'yourClientSecret',
        'redirectUri' => 'http://yourhost.com/wunderlist/callback'
    ]);
```

Here is an example of how we can access all lists:

```php
    //Here we get the lists service, we did not get the lists yet
    $listsService = $wunderlist->getLists();
    
    //Here we get all lists for the authenticated user
    $listsService->all()->done(function($lists){
        $lists->each(function($list) {
            echo $list->getTitle();
        });
    });
```

What about all taks for a list?

```php
    $listsService = $wunderlist->getLists();
    $tasksService = $wunderlist->getTasks();
    
    $listsService->all()->done(function ($lists) use ($tasksService) {
        $lists->each(function ($list) use ($tasksService) {
            $tasksService->forList($list)->done('getTasks');
        });
    });
    
    function getTasks($tasks)
    {
        $tasks->each(function ($task) {
            echo $task->getTitle() . '<br>';
        });
    }
```

Ok, now lets create a task for a list

```php
$listsService = $wunderlist->getLists();
$tasksService = $wunderlist->getTasks();

//Here we get all lists for the authenticated user
$lists = $listsService->all()->done(function ($lists) use ($tasksService) {
    //We get the first list
    $list = $lists->first();

    $task = new \Wunderlist\Entity\Task();
    $task
        ->setListID($list->getId())
        ->setTitle('Hello I am a Task for the first list');

    $tasksService->create($task)->done(function ($task) {
        echo 'Created Task ID: ' . $task->getId() . '<br>';
    });
});
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
