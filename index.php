<?php
/**
 * My own blog.
 *
 * Index
 *
 * PHP Version 7
 * 
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  GIT: $Id$ In development. 
 * @link     http://projet5.philippetraon.com
 */
session_start();
session_regenerate_id();
require 'vendor/autoload.php';
require 'src/router.php';

$router = new Router();
$router->run();