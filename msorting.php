<?php

function array_msort($array, $cols)
{
	// clean cols
	$cols = (array) $cols;
	foreach ($cols as $col => $order) {
		if (is_int($col)) {
			// unassociative array.
			$cols[$order] = SORT_ASC;
			unset($cols[$col]);
		}
	}

	$colarr = array();
	foreach ($cols as $col => $order) {
		$colarr[$col] = array();
		foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
	}
	$params = array();
	foreach ($cols as $col => $order) {
		$params[] =& $colarr[$col];
		foreach ((array) $order as $i=> $orderArg)
		{
			$uniqueFlag = $col.'_'.$i.'_flag';
			$$uniqueFlag = $orderArg;
			$params[] = &$$uniqueFlag;
		}
	}

	call_user_func_array('array_multisort', $params);
	$sorted = array();
	$keys = array();
	$first = true;
	foreach ($colarr as $col => $arr) {
		foreach ($arr as $k => $v) {
			if ($first) { $keys[$k] = substr($k,1); }
			$k = $keys[$k];
			if (!isset($sorted[$k])) $sorted[$k] = $array[$k];
			$sorted[$k][$col] = $array[$k][$col];
		}
		$first = false;
	}
	$array = $sorted;
	return $array;
}