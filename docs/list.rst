=====
Lists
=====

Provides specifics methods for easy access to list data.

Get all accepted lists

.. code-block:: php

    $acceptedLists = $wunderlist->getService(WList::class)->accepted();

Make a list public

.. code-block:: php

    $list = $wunderlist->find(WList::class, 777);
    $listsService->makePublic($list);

Make a list private

.. code-block:: php

    $list = $wunderlist->find(WList::class, 777);
    $listsService->makePrivate($list);