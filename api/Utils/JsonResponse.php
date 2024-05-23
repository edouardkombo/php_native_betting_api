<?php

namespace Api\Utils;

use Api\Abstractions\GetterSetter as GetterSetter;

class JsonResponse extends GetterSetter
{
    public static function get($body)
    {
	$result = [];
        if(!empty($body))
        {
            $result = array('status' => 200, 'body' => $body);
        } else {
            $result = array('status' => 404);
	}

	return json_encode($result);
    }
}
