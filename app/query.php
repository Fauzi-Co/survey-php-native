<?php
// query_select('table', 'all', $select = "id=7")
function query_select($table = false, $select = null, $join = null)
{
	global $conn;

	if ($select) {
		// where select
		$result = mysqli_query($conn, "SELECT * FROM " . $table . " WHERE " . $select);
	} else {
		// get all

		if ($join) {
			$result = mysqli_query($conn, "SELECT * FROM " . $table . " $join");
		} else {
			$result = mysqli_query($conn, "SELECT * FROM " . $table);
		}
	}

	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		// menjadikan variabel $rows[] array assosiatif
		$rows[] = $row;
	}

	//mengembalikan array assosiatif
	return $rows;
}

function query_insert($table, $data)
{
	global $conn;

	$value = "";
	$i = 1;
	foreach ($data as $val) {
		$value .= "'" . $val . "'";
		if ($i != count($data)) {
			$value .= ", ";
		}
		$i++;
	}
	unset($i);

	mysqli_query($conn, "INSERT INTO $table VALUES($value)");
	return mysqli_affected_rows($conn);
}

function query_delete($table, $where)
{
	global $conn;

	mysqli_query($conn, "DELETE FROM $table WHERE $where");
	return mysqli_affected_rows($conn);
}
