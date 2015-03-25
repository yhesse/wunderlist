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

$list = $lists->getID(148646750);
dump(
    $memberships->mine(),
    $tasks->all($list)
//    $lists->all(),
//    $lists->get(148646750),
//    $lists->getTaskCounts(148646750)
//    $wunderlist->createList([
//        'title' => 'Test SDK'
//    ])
);