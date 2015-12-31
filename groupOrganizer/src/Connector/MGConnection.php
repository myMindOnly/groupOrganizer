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

use \GOrganizer\Configuration\Config;

/**
 * 
 * @author Osama Agha <osama.agha24@gmail.com>
 */
class MGConnection
{
    public function getConnection()
    {
        $host = Config::mongoHost();
        $connection = new MongoClient( "mongodb://$host[host]:$host[port]" ); // connect to a remote host at a given port
        return $connection;
    }

}
