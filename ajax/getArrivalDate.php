<?php 
// $duration 		=	$_POST['duration'];
// $departureDate 	=	$_POST['departureDate'];

$duration 		=	isset($_POST['duration']) ? $_POST['duration'] : null;
$departureDate 	=	isset($_POST['departureDate']) ? $_POST['departureDate'] : null;

if(!empty($duration) && !empty($departureDate)){

	$date = date("Y-m-d", strtotime($departureDate));
	$date = date_create($date);
	date_modify($date, '+'.$duration .' day');

	echo date_format($date, 'd.m.Y');
	
}