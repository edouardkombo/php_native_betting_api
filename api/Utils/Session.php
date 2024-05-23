<?php

namespace Api\Utils;

use Api\Abstractions\GetterSetter as GetterSetter;

class Session extends GetterSetter
{
    public static function set($data, $value)
    {
	$_SESSION[$data] = $value;
    }

    public static function get($data)
    {
	if (!isset($_SESSION[$data]))
	{
	    throw new \Exception("Session $data is invalid!");
	}

        return $_SESSION[$data];
    }
}
