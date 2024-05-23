<?php

namespace Api\Interfaces;

interface Http
{
    public function get();
    public function post($data);
    public function delete($data);
    public function put($data);
}
