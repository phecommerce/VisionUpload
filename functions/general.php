<?php

function output_errors($errors) {
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

function array_sanitize(&$item) {
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function update_data($id, $update_data, $table) {
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	
	$sql = "UPDATE `$table` SET " . implode(', ', $update) . " WHERE `id` = '$id'";
}

function insert($values,$table) {
	array_walk($values, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($values)) . '`';
	$data = '\'' . implode('\', \'', $values) . '\'';
	
	$sql = "INSERT INTO `$table` ($fields) VALUES ($data)";
}

function delete($id, $table){
	$sql = "DELETE FROM  `$table`  WHERE `id` = '$id'";	
}



?>