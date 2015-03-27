=====
Lists
=====

Provides methods for easy access to list data.

Create an instance of the Lists service

.. code-block:: php

    $listsService = $wunderlist->getLists();

Get all lists for a user

.. code-block:: php

    $user = $userService->current();
    $lists = $listsService->forUser($user);

Get a specific list

.. code-block:: php

    $list = $listsService->getID(777);

Create a list

.. code-block:: php

    $list = new Wunderlist\Entity\List();
    $list->setTitle('Bad Movies');
    $listsService->create($list);

Update a list

.. code-block:: php

    $list = $listsService->getID(777);
    $list->setTitle('Good Bad Movies');
    $listsService->update($list);

Delete a list

.. code-block:: php

    $list = $listsService->getID(777);
    $listsService->delete($list);