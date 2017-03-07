<?php

require_once 'header.html';
if(!file_exists("data.txt")){
	if(isset($_REQUEST['send'])){
		$file = fopen('data.txt', 'w+');
		$req_data=array();
		$req_data[] = $_REQUEST['name'];
		$req_data[] = $_REQUEST['surname'];
		$req_data[] = $_REQUEST['occupation'];
		$req_data[] = $_REQUEST['telephone'];
		$f_wr = fwrite($file, implode("|", $req_data));
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
	$file_data = explode("|", $file);
	echo "<p>Name: {$file_data[0]}</p>";
	echo "<p>Surname : {$file_data[1]}</p>";
	echo "<p>Occupation: {$file_data[2]}</p>";
	echo "<p>Phone number : {$file_data[3]}</p>";
}
// function array_to_string($arr){
// 	$string = "[";
// 	foreach ($arr as $el) {
// 		if(!is_array($el)){
// 			$string .= $el.'|';
// 		}else{
// 		    $string .= array_to_string($el).'|';
// 		}
// 	}
// 	return substr($string,0,strlen($string)-1)."]";
// }
// function string_to_array($str){
//     $result = array();
//     $arr = str_split($str);
//     for( $i = 1; $i < count($arr) - 1; $i++){
//         if($arr[$i] != '|'){
//             if($arr[$i] == "[")
//                 $result[] = string_to_array(substr($str,$i));
//             elseif($arr[$i] == "]") {
//                 break;
//             }
//             else
//                 $result[] = $arr[$i];
//         }
//         else
//             continue;
//     }
//     return $result;
    
// }
require_once 'footer.html';