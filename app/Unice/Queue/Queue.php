<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 17/09/2017
 * Time: 22:26
 */

namespace App\Unice\Server\Queue;


use Illuminate\Redis\Connections\Connection;

/**
 * Class Queue
 * @package App\Unice\Server\Queue
 */
class Queue
{
    /**
     * @var string
     */
    protected $queueKey = 'wsQueues';

    /**
     * @var Connection
     */
    protected $redis;

    /**
     * @var
     */
    protected $connection;

    /**
     * Queue constructor.
     */
    function __construct()
    {
        $this->queueKey = config('cache.prefix') . ':' . $this->queueKey;

        $this->connection();

    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function connection(string $name = null)
    {
        $this->redis = \Redis::connection($name);
        return $this;
    }

    /**
     * @param $message
     * @return $this
     */
    public function push($message)
    {
        $this->redis->rpush($this->queueKey, $message);
        return $this;
    }

    /**
     * @param int $count
     * @return \Illuminate\Support\Collection
     */
    public function pull($count = 1)
    {
        $coll = collect();

        for ($i = 0; $i < $count; $i++) {
            $msg = $this->redis->lpop($this->queueKey);
            if ($msg) {
                $coll->push($msg);
            }
        }

        return $coll;
    }
    
}