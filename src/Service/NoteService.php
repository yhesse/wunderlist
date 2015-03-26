<?php

namespace Wunderlist\Service;

use Wunderlist\Entity\Note;

class NoteService extends AbstractService
{
    protected $baseUrl = 'notes';
    protected $type = Note::class;
}
