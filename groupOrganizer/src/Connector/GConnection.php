<?php

/*
 * This file is part of the groupOrganizer.
 * 
 * (c) Osama Agha <osama.agha24@gmail.com>
 * and open the template in the editor.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GOrganizer\Connector;

use \Predis\Client;
use \GOrganizer\Configuration\Config;

/**
 * 
 * @author Osama Agha <osama.agha24@gmail.com>
 */
class GConnection
{
    public function getConnection()
    {
        $connection = new Client(Config::redisHost());
        return $connection;
    }

}
