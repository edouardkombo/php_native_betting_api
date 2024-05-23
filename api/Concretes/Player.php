<?php

namespace Api\Abstractions\Database;

use Api\Abstractions\Connection;
use Api\Utils\QueryResponse;
use Api\Abstractions\Database\Player as PlayerAbstraction;

class Player extends PlayerAbstraction
{
    public $brand_id;
    public $credential_id;
    public $address_id;
    public $individual_id;
    public $security_id;
    public $wallet_id;
    public $gender_id;
    public $currency_id;

    public function get()
    {
        $sql = 'SELECT * FROM api.player WHERE id=:id';
        $stmt = self::connect->prepare($sql);
	$stmt->bindValue(":id", $_SESSION["player"]["id"]);
        $stmt->execute();

	return QueryResponse::get($stmt);
    }
}
