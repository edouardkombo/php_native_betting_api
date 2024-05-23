<?php

namespace Api\Abstractions\Database;

use Api\Abstractions\Http;
use Api\Utils\QueryResponse;

abstract class Credential extends Http
{
    public $username;
    public $password;
    public $db;
   
    public function get()
    {
        $sql = 'SELECT * FROM api.credential WHERE username=:username && password=:password';
        $stmt = $this->db->prepare($sql);
	$stmt->bindValue(":username", $this->username);
	$stmt->bindValue(":password", $this->password);
        $stmt->execute();

	return QueryResponse::get($stmt);
    }
}
