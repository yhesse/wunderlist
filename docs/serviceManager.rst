===============
Service Manager
===============

The service manager provides methods for easy access to API resources data data.
The manager tries to follow the same principle as a ObjectManager, from Doctrine, where you have a manager
to the repositories. Instead of a repository we have a service.

Create an instance of the resource service

.. code-block:: php

    $listsService = $wunderlist->getService(WList::class);

Get all records for a resource

.. code-block:: php

    $lists = $wunderlist->getService(WList::class)->all();

Get a specific resource

.. code-block:: php

    $list = $wunderlist->find(WList::class, 777);

Get a specific resource for a user

.. code-block:: php

    $user = $wunderlist->getService(User::class)->current();
    $lists = $wunderlist->forUser(WList::class, $user);

Get a specific resource for a list

.. code-block:: php

    $list = $wunderlist->find(WList::class, 777);
    $tasks = $wunderlist->forList(Task::class, $list);

Get a specific resource for a task

.. code-block:: php

    $task = $wunderlist->find(Task::class, 777);
    $subtasks = $wunderlist->forTask(Subtask::class, $task);

Create a resource

.. code-block:: php

    $list = new Wunderlist\Entity\WList();
    $list->setTitle('Bad Movies');
    $wunderlist->save($list);

Update a resource

.. code-block:: php

    $list = $wunderlist->find(WList::class, 777);
    $list->setTitle('Good Bad Movies');
    $wunderlist->save($list);

Delete a resource

.. code-block:: php

    $list = $wunderlist->find(WList::class, 777);
    $wunderlist->delete($list);