<?php

namespace Tests\Wunderlist;

use PHPUnit_Framework_TestCase;

/**
 * Description of Collection
 *
 * @author italo
 */
abstract class WunderlistTestCase extends PHPUnit_Framework_TestCase
{
    protected $wunderlist;

    protected function setUp()
    {
        date_default_timezone_set('America/Recife');
    }

}
