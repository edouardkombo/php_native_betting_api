<?php

namespace Api\Abstractions\Database;

use Api\Abstractions\Http;
use Api\Utils\BoolResponse;
use Api\Utils\QueryResponse;
use Api\Utils\Session;

abstract class Wallet extends Http
{
    public $balance;
    public $db;

    public function get()
    {
        $sql = 'SELECT * FROM api.wallet WHERE player_id=:player_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":player_id", Session::get("player_id"));
        $stmt->execute();

	$response = QueryResponse::get($stmt);

	if ($response)
	{
	    Session::set("wallet", $response);
	}

        return $response;        
    }

    public function put($payload)
    {
        $sql = 'UPDATE api.wallet SET balance=:balance WHERE player_id=:player_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":balance", $this->balance);
        $stmt->bindValue(":player_id", Session::get("player_id"));
	$stmt->execute();

        return BoolResponse::get($stmt);
    }
}
