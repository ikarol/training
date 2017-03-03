<?php
	if($_REQUEST['login'] && $_REQUEST['password'] 
		&& $_REQUEST['Send'] == 'Submit'){
			echo "Доступ разрешён для {$_REQUEST['login']} !";
	}else {
		die("Доступ запрещён");
	}