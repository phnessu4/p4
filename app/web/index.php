<?php
/**
 * @author phnessu4 phnessu4@gmail.com
 * @copyright stylejar.com
 */
require_once 'config.inc.php';
require_once 'debuger.php';
require_once '../../lib/index.php';
core_dispatcher::instance()->run($_SERVER['REQUEST_URI']);
?>