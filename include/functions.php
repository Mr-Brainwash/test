<?php

//получение названия региона
function getCityName($id) 
{
 	require '../config/base.php';

 	if ($id) {
 		$region = $dbh->query('SELECT region FROM `regions` WHERE id = "' .$id. '"');
 		$name = $region->fetchColumn();
 		return $name;
 	} else {
 		return '';
 	}
}

//получение имени курьера
function getCourierName($id) 
{
 	require '../config/base.php';

 	if ($id) {
 		$courier = $dbh->query('SELECT name FROM `couriers` WHERE id = "' .$id. '"');
 		$name = $courier->fetchColumn();
 		return $name;
 	} else {
 		return '';
 	}
}