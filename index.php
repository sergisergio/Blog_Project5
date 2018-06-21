<?php
/**
 * My own blog.
 *
 * Index
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
session_start();
require "vendor/autoload.php";
require 'src/router.php';

$router = new Router();
$router->run();