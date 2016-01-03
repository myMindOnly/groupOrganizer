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

namespace GOrganizer\Configuration;

/**
 * Description of Config
 *
 * @author Osama Agha <osama.agha24@gmail.com>
 */
// distribute data on the redis databases based on first number of user id
define('DISTRIBUTE_DATA_BY_USERID', FALSE);
// select redis data base for all data ,it not meaningful if DISTRIBUTE_DATA_BY_USERID is true
define('REDIS_GROUP_DATABASE', 0);



class Config
{
    /**
     * 
     * @return redis connction
     * 
     * @author Osama Agha <osama.agha24@gmail.com>
     */
    public static function redisHost()
    {
        return array(
            'scheme' => 'tcp',
            'host' => 'localhost',
            'port' => 6379,
        );
    }

    public static function register()
    {
        return 0;
    }

}
