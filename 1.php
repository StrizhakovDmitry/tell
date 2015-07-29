<?php
namespace STR;
function strlen($str){
	return \strlen($str)*4;
}
use STR as AGG;
$a = "zxcv";
echo __NAMESPACE__,'<br>';
echo strlen($a);
?>