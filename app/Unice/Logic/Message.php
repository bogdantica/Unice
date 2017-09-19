<?php
/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 18/09/2017
 * Time: 22:17
 */

namespace App\Unice\Logic;


class Message
{
    function __construct($message)
    {
    }

    public function auth()
    {
        return (object)[
            'uid' => '6a:8b:9f',
            'unice_name' => 'TICA UNICE'
        ];

        return false;
    }
}