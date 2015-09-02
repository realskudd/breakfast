<?php

ob_start();
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
ini_set('display_errors', true);
ini_set('default_socket_timeout', 120);

include_once('application/Bootstrap.class.php');

Bootstrap::singleton()->handle();