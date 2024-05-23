<?php

namespace Api\Abstractions;

use Api\Interfaces\Database;
use PDO;

abstract class Connection implements Database
{
    public static $instance;

    public static function connect()
    {
        if (!isset(self::$instance)) {
              self::$instance = new PDO('mysql:host=localhost;dbname='.$_ENV["DB_NAME"].'', $_ENV["DB_USER"], $_ENV['DB_PASSWORD'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
              self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }
        return self::$instance;
    }
}
