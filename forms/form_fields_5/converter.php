<?php
/**
 * converts array to string
 * @param  Array $arr array argument
 * @return String      converted array
 */
function array_to_string($arr){
	$string = "[";
	foreach ($arr as $el) {
		if(!is_array($el)){
			$string .= $el.'|';
		}else{
		    $string .= array_to_string($el).'|';
		}
	}
	return substr($string,0,strlen($string)-1)."]";
}
/**
 * Converts string to array
 * @param  String $str input string
 * @return Array      converted string
 */
function string_to_array($str){
    $result = array();
    $arr = str_split($str);
    $el = "";
    for( $i = 1; $i < count($arr); $i++){
        if($arr[$i] != '|'){
            if($arr[$i] == "["){
                $result[] = string_to_array(substr($str,$i));
                $sub_arr = $result[count($result)-1];
                $steps = 0;
                foreach($sub_arr as $q){
                  if (is_array($q)){
                    $steps += count($q);
                    continue;
                  }
                  $steps += strlen((string)$q);
                }
                $steps += count($sub_arr);
                $i += $steps;
                continue;
            }
            elseif($arr[$i] == "]") {
                if($el != ''){
                    $result[] = $el;
                    $el = "";
                }
                break;
            }
            else{
                
                $el .= $arr[$i];
            }
        }
        else{
            if($el != ''){
                $result[] = $el;
                $el = "";
            }
            continue;
        }
    }
    return $result;
}