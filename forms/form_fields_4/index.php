<?php 
require_once "header.html";
if(!isset($_REQUEST['greet'])){
	require_once "form.html";
}else {
	if($_REQUEST['name'] != '')
		echo "<h1>Hello, {$_REQUEST['name']}</h1>";
	else{ 
		echo "Enter your name";
		require_once "form.html";
	}
}
require_once "footer.html";
