=====
Tasks
=====

Provides methods for easy access to tasks data.

Create an instance of the Tasks service

.. code-block:: php

    $tasksService = $wunderlist->getTasks();

Get completed tasks for a list

.. code-block:: php

    $list = $listService->getID(777);
    $lists = $tasksService->forList($list, true);

Get today tasks

.. code-block:: php

    $todayTasks = $tasksService->today();

Get overdue tasks

.. code-block:: php

    $overdueTasks = $tasksService->overdue();

Get a specific task

.. code-block:: php

    $task = $tasksService->getID(777);

Create a task

.. code-block:: php

    $task = new Wunderlist\Entity\Task();
    $task->setTitle('Call Jenny')
        ->setListID(8675309);
    $tasksService->create($task);

Update a task

.. code-block:: php

    $task = $tasksService->getID(777);
    $task->setTitle('Change the world')
        ->setStarred(true);
    $tasksService->update($task);

Delete a task

.. code-block:: php

    $task = $tasksService->getID(777);
    $tasksService->delete($task);