<?php
require_once('../lib/config.inc.php');
core_dispatcher::instance()->dispatcher($_SERVER['REQUEST_URI']);
//http://samuelsjoberg.com/archive/2007/01/url-dispatcher
?>