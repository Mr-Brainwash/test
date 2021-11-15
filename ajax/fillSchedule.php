<?php 

include '../config/base.php';

$courier		=	$_POST['courier'];
$region			=	$_POST['region'];
$departureDate	=	strtotime($_POST['departureDate']);
$arrivalDate	=	strtotime($_POST['arrivalDate']);
$departure_date	= 	date('Y-m-d', $departureDate);
$return_date 	= 	date('Y-m-d', $arrivalDate);

$control = "SELECT DISTINCT couriers.id
FROM couriers 
INNER JOIN travel_schedule 
ON courier_id = :courier 
AND ((departure_date >= :departure_date AND departure_date <= :return_date) 
OR (return_date >= :departure_date AND return_date <= :return_date))";


$data = $dbh->prepare($control);
$data->bindValue(':courier', $courier);
$data->bindValue(':departure_date', $departure_date);
$data->bindValue(':return_date', $return_date);
$data->execute();
$value = $data->fetch(PDO::FETCH_COLUMN);

if($value) {  

	echo '2';
	die();

} else {

	$sql = "INSERT INTO travel_schedule (courier_id, region_id, departure_date, return_date) 
	VALUES (:courier, :region, :departure_date, :return_date)";

	$statement	= $dbh->prepare($sql);

	$statement->bindValue(':courier', $courier);
	$statement->bindValue(':region', $region);
	$statement->bindValue(':departure_date', $departure_date);
	$statement->bindValue(':return_date', $return_date);

	$statement->execute();

	$LID = $dbh->lastInsertId();

	echo isset($LID) ? '1' : '0';

}