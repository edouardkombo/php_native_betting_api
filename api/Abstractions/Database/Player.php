<?php

namespace Api\Abstractions\Database;

use Api\Abstractions\Http;
use Api\Utils\QueryResponse;
use Api\Utils\Session;

abstract class Players extends Http
{
    public $brand_id;
    public $credential_id;
    public $address_id;
    public $individual_id;
    public $security_id;
    public $wallet_id;
    public $gender_id;
    public $currency_id;
    public $db;

    public function get()
    {
        $sql = 'SELECT * FROM api.player WHERE id=:id';
        $stmt = $this->db->prepare($sql);
	$stmt->bindValue(":id", Session::get("player_id"));
        $stmt->execute();

	return QueryResponse::get($stmt);
    }
}
