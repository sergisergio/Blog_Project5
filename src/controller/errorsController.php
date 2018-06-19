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
namespace Philippe\Blog\Src\Controller;

class errorsController
{
	/**
	 * Function errors
	 * 
	 * @return mixed
	 */
	function errors()
	{
	    include 'views/frontend/Modules/Blog/Errors/errors.php';
	}
	/**
	 * Function noAdmin
	 * 
	 * @return mixed
	 */
	function noAdmin()
	{
	    include 'views/frontend/Modules/Blog/Errors/noadmin.php';
	}
}