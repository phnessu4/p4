<?php
/**
 * @author phnessu4 phnessu4@gmail.com
 * @copyright stylejar.com
 */
define('APP_NAME','app');
define('APP_ROOT',realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR .'..' ));

require_once 'debuger.php';
require_once '../../lib/index.php';
p4::instance()->run($_SERVER['REQUEST_URI']);
?>