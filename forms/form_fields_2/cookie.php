<?php
	if($_REQUEST['login'] && $_REQUEST['password']){
		$count = 0;
		if (isset($_COOKIE['count'])) $count = $_COOKIE['count'];
		$count++;
		setcookie("count", $count, time()+60*60*24*100);
		echo $count;
	} else{
		die('Неправильный логин или пароль');
	}