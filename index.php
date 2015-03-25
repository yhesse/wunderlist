<?php

require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$wunderlist = new \Wunderlist\Wunderlist([
    'clientId' => '201e89d29b791500a408',
    'clientSecret' => '169e33f7536bc596be07301b609a412602d9dcc5991491019f623eaa7649',
    'redirectUri' => 'http://localhost/wunderlist/'
]);

$lists = $wunderlist->getLists();
$memberships = $wunderlist->getMemberships();
$tasks = $wunderlist->getTasks();
$subtasks = $wunderlist->getSubtasks();

$list = $lists->getID(154389739);
$task = $tasks->getID(1063439979);

//$task = new \Wunderlist\Entity\Task();
//$task
//    ->setListID($list->getId())
//    ->setTitle('Test Hello');
//

//$subtask = new \Wunderlist\Entity\Subtask();
//$subtask->setTaskID($task->getId())
//    ->setTitle('Subtask Test');

dump(
//    $lists->all(),
//    $memberships->mine(),
    $lists->delete($lists->getID(154205231)),
    $tasks->forList($list, true),
    $tasks->allWithSubtasks($list)
);