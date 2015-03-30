==========
Quickstart
==========

This page provides a quick introduction to Wunderlist PHP SDK and introductory examples.
If you have not already installed, Wunderlist PHP SDK, head over to the :ref:`installation`
page.

The SDK is pretty simple to use, here is an example of how we can access all lists:

.. code-block:: ph

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


What about all taks for a list?

.. code-block:: ph

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


Ok, now lets create a task for a list

.. code-block:: php
    <?php

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


This is just some simple things you can do with the SDK. Whant more? please just read our [documentation](http://wunderlist.readthedocs.org/)


Requests
========

By default all requests made to the API are syncronous, this is because we use the *GuzzleAdapter*.
But if you want to make asyncronous request you need to change the adapter *AsyncGuzzleAdapter*, this
will allow to make calls like this:

.. code-block:: php

     $service = $wunderlist->getService(WList::class);
     $service->all()->done(function($lists){
            $lists->map(function($list){
                echo $list->getTitle();
            });
     });

To change the default HttpClient adapter just change on *ClientBuilder*:

.. code-block:: php

    $builder = new Wunderlist\ClientBuilder();
    $wunderlist = $builder->setHttpClient(Wunderlist\Http\AsyncGuzzleAdapter::class)
                          ->build();