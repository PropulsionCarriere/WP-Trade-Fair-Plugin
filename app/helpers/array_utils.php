<?php

function tf_array_rotate($array, $offset){
	$length = count($array);
	$offset = $offset % $length;
	$startSlice = array_slice($array,0, $length-$offset);
	$endSlice = array_slice($array, $length-$offset);
	return array_merge($endSlice, $startSlice);
}
