<?php

namespace Api\Utils;

use Api\Abstractions\GetterSetter as GetterSetter;

class BoolResponse extends GetterSetter
{
    public static function get($stmt)
    {
	return ($stmt->rowCount() > 0) ? true : false;
    }
}
