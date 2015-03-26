<?php

namespace Tests\Wunderlist;

use PHPUnit_Framework_TestCase;
use Wunderlist\Provider\Wunderlist;

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
        $this->wunderlist = new Wunderlist([
            'clientId' => '201e89d29b791500a408',
            'clientSecret' => '169e33f7536bc596be07301b609a412602d9dcc5991491019f623eaa7649',
            'redirectUri' => 'http://localhost/wunderlist/'
        ]);
    }

}
