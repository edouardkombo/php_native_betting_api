<?php

namespace Api\Utils;

use Api\Abstractions\GetterSetter as GetterSetter;
use PDO;

class QueryResponse extends GetterSetter
{
    public static function get($stmt)
    {
	$result = [];
        if($stmt->rowCount() > 0)
        {
            $row  = $stmt->fetch(PDO::FETCH_ASSOC);
            $result = $row;
        }

	return $result;
    }
}
