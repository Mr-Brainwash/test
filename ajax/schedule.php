<?php 

include '../config/base.php';
include '../include/functions.php';

$post 	= isset($_POST['data']) ? $_POST['data'] : null;
$myDate = date('Y-m-d', strtotime($post));

$sql = "SELECT * FROM travel_schedule WHERE departure_date = :myDate";

$tableData	= $dbh->prepare($sql);
$tableData->bindValue(':myDate', $myDate);
$tableData->execute();

if($tableData->rowCount()) {

    $i = 1;
	$res = '';
	$res .= '<div class="table-responsive"> 
	            <table class="table table-bordered table-condensed table-striped">
	                <thead>
	                    <tr>
	                        <th>№</th>
	                        <th>Курьер</th>
	                        <th>Регион</th>
	                        <th>Дата выезда</th>
	                        <th>Дата возвращения</th>
	                    </tr>
	                </thead>
	                <tbody>';
	                    	foreach ( $tableData as $value ){
								$res .= '<tr>
								    <td>'.$i.'</td>
								    <td>'.getCourierName($value['courier_id']).'</td>
								    <td>'.getCityName($value['region_id']).'</td>
								    <td>'.date('d.m.Y', strtotime($value['departure_date'])).'</td>
								    <td>'.date('d.m.Y', strtotime($value['return_date'])).'</td>
								</tr>';
								$i++;       
							}
	$res .=         '</tbody>
	            </table>
	        </div> ';
	echo $res;
} else {
	echo '<h3 class="panel-title text-center">Нет данных за выбранный день.</h3>';
}