==========
Quickstart
==========

This page provides a quick introduction to Wunderlist PHP SDK and introductory examples.
If you have not already installed, Wunderlist PHP SDK, head over to the :ref:`installation`
page.

Sync
----

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
