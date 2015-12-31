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

namespace GOrganizer\Redis;

use GOrganizer\Redis\Redis;

/**
 * Description of SpecialCommand
 *
 * @author  Osama Agha <osama.agha24@gmail.com>
 */
class SpecialCommand extends Redis
{
    /**
     * 
     * @param type $key
     * @param type $value
     * @return boolean
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function addValueToZSet($key, $value)
    {
        $this->multi();
        $this->zRevrangeByScore($key);
        $this->ZScore($key, $value);
        $result = $this->exec();

        if (empty($result[1])) {
            $lastScore = (int) array_pop($result[0]);
            $this->zAdd($key, ++$lastScore, $value);
            return true;
        }
        return false;
    }

}
