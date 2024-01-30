<?php
require_once __DIR__ . "/footbal.php";
class Useage extends Footbal
{
    public function __construct()
    {
        parent::__construct();
    }
    public function setting_response()
    {
        $funcargs = func_get_args();
        $matches = parent::get_request(...$funcargs);

    }

}