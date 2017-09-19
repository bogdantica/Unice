<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 18/09/2017
 * Time: 22:07
 */

namespace App\Unice\Server\Ratcher;

use Ratchet\ConnectionInterface;

class Client
{
    const GUEST = 10;
    const UNICE = 20;

    protected $type;
    protected $uid;
    protected $unice;

    /**
     * @var ConnectionInterface
     */
    protected $conn;

    function __construct($conn, int $type = self::GUEST)
    {
        $this->conn = $conn;
        $this->setType($type);
        $this->setUid($conn->uid);
    }

    public function setType(int $type)
    {
        $this->type = $type;
        $this->conn->type = $type;

        switch ($this->type) {
            case static::UNICE:
                //todo set online
                break;
        }
        return $this;

    }

    public function getType()
    {
        return $this->type;
    }

    public function setConn($conn)
    {
        $this->conn = $conn;
        return $this;
    }

    public function setUid($uid)
    {
        $this->uid = $uid;
        $this->conn->uid = $this->uid;
        return $this;

    }

    public function getUid()
    {
        return $this->uid;
    }

    public function setUnice($unice)
    {
        $this->unice = $unice;
        return $this;

    }

    public function getUnice()
    {
        return $this->unice;
    }

    public function send($msg)
    {
        $this->conn->send($msg);
    }

    public function close($msg = null)
    {
        if (!is_null($msg)) {
            $this->send($msg);
        }

        $this->conn->close();

        $this->closed();
    }

    public function closed()
    {
        switch ($this->type) {
            case static::UNICE:
                //todo set offline
                break;
            default:
        }

    }

    public function parseMessage($msg)
    {
        dump($msg);
        $this->send('Ai trimis:' . $msg);
    }

}