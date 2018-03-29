<?php 

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function connexionAdmin()
{
	require('view/backend/index.php');
}
function indexManagement()
{
	require('view/backend/index_management.php');
}
function managePosts()
{
	require('view/backend/post_mgmt.php');
}
function manageComments()
{
	require('view/backend/comment_mgmt.php');
}
function manageUsers()
{
	require('view/backend/user_mgmt.php');
}