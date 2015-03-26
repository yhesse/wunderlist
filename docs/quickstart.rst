==========
Quickstart
==========

This page provides a quick introduction to Wunderlist PHP SDK and introductory examples.
If you have not already installed, Wunderlist PHP SDK, head over to the :ref:`installation`
page.

Services
==============

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

Authentication
==============

The Wunderlist API uses OAuth2 to allow external applications to request authorization
to a user’s Wunderlist account without directly handling their password.
Developers must register their application before getting started. Registration assigns
a unique client ID and client secret for your application’s use. After you have registered
your application, you can let Wunderlist users authorize access to their account information
from your application by getting an access token.
After a user has authorized your application and you have an access token, you can use it
in Wunderlist API requests by setting the X-Client-ID and X-Access-Token HTTP request headers.

Our SDK handles this procedure very well. For this we have a some simple steps to make.
Just remeber that this procedure is already done by our SDK, this is just an stand alone service
if you want to use it.

.. code-block:: php
    //We create a provider which can handle the authentication procedure
    $provider = new \Wunderlist\Provider\Wunderlist([
        'clientId' => 'yourClientId',
        'clientSecret' => 'yourClientSecret',
        'redirectUri' => 'http://yourhost.com/wunderlist/callback'
    ]);

    //We create a service which can handle the provider procedure and store the result in session
    $auth = new Wunderlist\Service\AuthenticationService($provider);

    //We ask for the user's authorization, this will make a redirect to the authorization view and then
    // redirects to your redicretUri. The redirectUri need to have this call again to handle the rest
    // of the flow
    $access_token = $auth->authorize();


Revisions and Sync
==============

Every entity in the Wunderlist API has a read-only revision property. This property is an integer which
is updated in response to changes to that entity or any of its children. When the title of a task is
changed, that task’s revision is updated—as well as the revisions of all of the parent items of that task,
including list and root entities.

Updating Entities
--------------

In order to guarantee that updates to Wunderlist entities are correctly executed and kept in sync across
clients, any changes to an entity through the API must be accompanied by the revision property. The server
uses this property to ensure that the client has the most up-to-date version of the entity. If a client
makes a request with an out-of-date revision property, the request will fail, indicating that the client
needs to fetch the entity’s current state and try again.
If an update request fails, you must fetch the current version of the entity, look for attributes that
conflict with your local state e.g. content on a note, and do some sort of local conflict resolution
before replaying your changes to the API with the current revision.

Sync
--------------

You can completely synchronize a local copy of the Wunderlist data model with the Wunderlist API by checking
the root revision property, descending if necessary, and repeating the process for each leaf in the tree.
When a russian doll sync occurs on a client, the following rules apply:
Fetched revision values and data should not be committed to local models and persistence layers unless child
resources are successfully fetched. This means you should not update the child-revision of the parent until
all child data has been successfully fetched. E.g. you should not apply list data and revision changes unless
all tasks were fetched successfully, etc.
Deleted items can be found by comparing your local data to the data retrieved during a russian doll sync and
comparing for missing ids. However, since tasks may be moved to another list, you should mark a task as
missing and only delete it if it is not present in any lists when the russian doll sync has completed
successfully. This pattern can be extended to any model type that is “moveable”.
