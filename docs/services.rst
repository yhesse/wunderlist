========
Services
========

A service is something that can be consumable by our API client. For example, lists, tasks.
Any service implements the ServiceInterface interface. All services has these base methods
wich can be vey useful:

.. code-block:: php

    //Gets a entity base on the ID
    $service->getID(123456789);

    //Gets the base url used to consume the API
    $service->getBaseUrl();

    //Makes a GET request to the API
    $service->get('lists');

    //Creates an entity at the API
    $service->create($entity);

    //Updates an entity at the API
    $service->update($entity);

    //Deletes an entity from the API
    $service->delete($entity);

    //Performs a GET for a user ID on the resource.
    $service->forUser($user);

    //Performs a GET for a task ID on the resource.
    $service->forTask($task);

    //Performs a GET for a list ID on the resource.
    $service->forList($list);

    //Updates only certain fields at the API
    $service->patch(123456789, ['completed' => true]);

You can create a service for wunderlist API, you just need to implement *ServiceInterface*, or if you
want to have the implementations above, extend from *AbstractService*

If you want to have readonly operations in your service, you need to extend from *AbstractGetOnlyService*

.. code-block:: php

    class MyService extends AbstractService
    {
        /**
         * The service's base path. For example 'tasks' will become 'https://a.wunderlist.com/api/v1/tasks'
         * when an HTTP request is made.
         * @var string
         */
        protected $baseUrl = 'avatar';

        /**
         * The service's resource type. For examples 'Task' for services/Tasks
         * @var string
         */
        protected $type = MyService::class;
    }
