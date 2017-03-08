<?php
require_once 'converter.php';
require_once 'header.html';
if(!file_exists("data.txt")){
	if(isset($_REQUEST['send'])){
		$file = fopen('data.txt', 'w+');
		$req_data=array();
		$req_data[] = $_REQUEST['name'];
		$req_data[] = $_REQUEST['surname'];
		$req_data[] = $_REQUEST['occupation'];
		$req_data[] = $_REQUEST['telephone'];
		$f_wr = fwrite($file, array_to_string($req_data));
		fclose($file);
		echo "<p>Name: {$req_data[0]}</p>";
		echo "<p>Surname : {$req_data[1]}</p>";
		echo "<p>Occupation: {$req_data[2]}</p>";
		echo "<p>Phone number : {$req_data[3]}</p>";
	} else{
		require_once 'main_form.html';
	}
}else {
	$file = file_get_contents('data.txt');
	$file_data = string_to_array($file);
	echo "<p>Name: {$file_data[0]}</p>";
	echo "<p>Surname : {$file_data[1]}</p>";
	echo "<p>Occupation: {$file_data[2]}</p>";
	echo "<p>Phone number : {$file_data[3]}</p>";
}
require_once 'footer.html';