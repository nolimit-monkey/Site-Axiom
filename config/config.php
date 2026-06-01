<?php
if (!defined('APP_STARTED')) {
    define('APP_STARTED', true);
}

$baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
define('BASE_URL', $baseUrl);
