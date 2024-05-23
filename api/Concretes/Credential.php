<?php

namespace Api\Concretes;

use Api\Abstractions\Database\Credential as CredentialAbstraction;
use Api\Utils\Session;
use Api\Utils\JsonResponse;

class Credential extends CredentialAbstraction
{
    public function __construct()
    {
    
    }

    public function authenticate()
    {
        $data = $this->get();
        $result = [];

	if (!empty($data))
	{
	    Session::set("player_id", $data["player_id"]);
            $result = ["player_id" => $data["player_id"]];
	}

	return JsonResponse::get($result);
    }
}
