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

use GOrganizer\Connector\GConnection;

/**
 * Description of Redis
 *
 * @author  Osama Agha <osama.agha24@gmail.com>
 */
class Redis
{

    private static $connection;

    /**
     * 
     * @param type $db
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function __construct($db)
    {
        $gConnection = new GConnection();
        if (empty($this->connection)) {
            $this->connection = $gConnection->getConnection();
            $this->connection->select($db);
        }
    }

    /**
     * 
     * @param type $key
     * @param type $score
     * @param type $val
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function zAdd($key, $score, $val)
    {
        return $this->connection->zAdd($key, $score, $val);
    }

    /**
     * 
     * @param type $key
     * @param type $val
     * @param type $incrBy
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function zIncrBy($key, $val, $incrBy = 1)
    {
        return $this->connection->ZINCRBY($key, $incrBy, $val);
    }

    /**
     * 
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function multi()
    {
        return $this->connection->multi();
    }

    /**
     * 
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function exec()
    {
        return $this->connection->exec();
    }

    /**
     * 
     * @param type $key
     * @param type $value
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function ZScore($key, $value)
    {
        return $this->connection->ZSCORE($key, $value);
    }

    /**
     * 
     * @param type $key
     * @param type $start
     * @param type $end
     * @param type $withscores
     * @param type $offset
     * @param type $count
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function zRevrangeByScore($key, $start = '+inf', $end = '-inf', $withscores = TRUE, $offset = 0, $count = 1)
    {
        //myzset +inf -inf WITHSCORES LIMIT 0 1
        return $this->connection->ZREVRANGEBYSCORE($key, $start, $end, array('withscores' => $withscores, $offset, 'limit' => array($offset, $count)));
    }

    /**
     * 
     * @param type $keyOutput
     * @param type $ZSetKeys
     * @param type $arrayWeights
     * @param type $aggregateFunction
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function zUnionStore($keyOutput, $ZSetKeys, $options = array())
    {
        return $this->connection->ZUNIONSTORE($keyOutput, $ZSetKeys, $options);
    }

    /**
     * 
     * @param type $keyOutput
     * @param type $ZSetKeys
     * @param type $arrayWeights
     * @param type $aggregateFunction
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function zInterStore($keyOutput, $ZSetKeys, $options = array())
    {
        return $this->connection->ZINTERSTORE($keyOutput, $ZSetKeys, $options);
    }

    /**
     * 
     * @param type $key
     * @param type $value
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function zRem($key, $value)
    {
        return $this->connection->ZREM($key, $value);
    }

    /**
     * 
     * @param type $key
     * @param type $start
     * @param type $end
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function zRange($key, $start = 0, $end = -1)
    {
        return $this->connection->ZRANGE($key, $start, $end);
    }

    /**
     * 
     * @param type $key
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function iNcr($key)
    {
        return $this->connection->INCR($key);
    }

    /**
     * 
     * @param type $key
     * @param type $sumKey
     * @param type $val
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function hSetNX($key, $sumKey, $val)
    {
        return $this->connection->HSETNX($key, $sumKey, $val);
    }

    /**
     * 
     * @param type $key
     * @param type $lementObject
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function hMSet($key, $lementObject)
    {
        return $this->connection->HMSET($key, $lementObject);
    }

    /**
     * 
     * @param type $key
     * @param type $value
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function hDel($key, $value)
    {

        return $this->connection->HDEL($key, $value);
    }

    /**
     * 
     * @param type $key
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function delete($key)
    {

        return $this->connection->del($key);
    }

    /**
     * 
     * @param type $key
     * @return type
     * 
     * @author  Osama Agha <osama.agha24@gmail.com>
     */
    public function hGetAll($key)
    {
        return $this->connection->HGETALL($key);
    }

}
