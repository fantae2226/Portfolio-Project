<?php

try {
	$dh = new PDO("mysql:host=localhost;dbname=nottwittertest", "root", "");
} catch (Exception $e) {
	$TPL["error"] = "Database Error: Could not connect!";
}

function queryDB ($query, $params) {
	global $dh;
	$stmt = $dh->prepare($query);
	$success = $stmt->execute($params);
	if ($success) {
		return $stmt->fetchall(PDO::FETCH_ASSOC);
	} else {
		return false;
	}
}

?>