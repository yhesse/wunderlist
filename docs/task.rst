=====
Tasks
=====

Provides specifics methods for easy access to tasks data.

Get today tasks

.. code-block:: php

    $todayTasks = $wunderlist->getService(Task::class)->today();

Get overdue tasks

.. code-block:: php

    $overdueTasks = $wunderlist->getService(Task::class)->overdue();

Get all tasks with its subtasks

.. code-block:: php

    $tasks = $wunderlist->getService(Task::class)->allWithSubtasks();

Filter tasks by date

.. code-block:: php

    $tasks = $wunderlist->getService(Task::class)->filterByDate(Carbon::now());