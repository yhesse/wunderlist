<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\Reminder;

class ReminderService extends AbstractService
{
    protected $baseUrl = 'reminders';
    protected $type = Reminder::class;
}
