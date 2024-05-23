<?php

namespace Api\Interfaces;

interface Agent
{
    public static function get($data);
    public static function set($data, $value);
}
