<?php
/**
 * My own blog.
 *
 * Errors Controller
 *
 * @category PHP
 * @package  Default
 * @author   Philippe Traon <ptraon@gmail.com>
 * @license  http://projet5.philippetraon.com Phil Licence
 * @version  PHP 7.1.14
 * @link     http://projet5.philippetraon.com
 */
/**
 * Function errors
 * 
 * @return mixed
 */
function errors()
{
    include 'App/frontend/Modules/Blog/errors.php';
}
/**
 * Function noAdmin
 * 
 * @return mixed
 */
function noAdmin()
{
    include 'App/frontend/Modules/Blog/noadmin.php';
}