<?php

namespace Api\Abstractions\Database;

use Api\Abstractions\Http;
use Api\Utils\BoolResponse;

abstract class Finance extends Http
{
    public $amount;
    public $payout;
    public $generated_number;
    public $wallet_id;
    public $finance_type_id;
    public $db;

    public function post($payload)
    {
        $sql = 'INSERT api.finance (amount,payout,generated_number,wallet_id,finance_type_id) VALUES (:amount,:payout,:generated_number,:wallet_id,:finance_type_id)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':amount', $this->amount);
        $stmt->bindValue(':payout', $this->payout);
	$stmt->bindValue(':generated_number', $this->generated_number);
	$stmt->bindValue(':wallet_id', $this->wallet_id);
	$stmt->bindValue(':finance_type_id', $this->finance_type_id);
        $stmt->execute();

	return BoolResponse::get($stmt);
    }
}
