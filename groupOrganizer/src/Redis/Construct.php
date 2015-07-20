<?php

/*
 * This file is part of the Predis groupOrganizer.
 * 
 * (c) Osama Agha <osama.agha24@gmail.com>
 * and open the template in the editor.
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GOrganizer\Redis;

use GOrganizer\Redis\Redis;
use GOrganizer\Redis\GenerateRedisKey;
use GOrganizer\Redis\SpecialCommand;

/**
 * Description of Construct
 *
 * @author  Osama Agha <osama.agha24@gmail.com>
 */
class Construct
{

    protected static $redis;
    protected static $redisKey;
    protected static $specialCommand;

    /**
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function __construct($db = 0)
    {
        if (empty($this->redis)) {
            $this->redis = new Redis($db);
        }

        if (empty($this->redisKey)) {
            $this->redisKey = new GenerateRedisKey();
        }
        if (empty($this->specialCommand)) {
            $this->specialCommand = new SpecialCommand($db);
        }
    }

}
