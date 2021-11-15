<?php require 'config/base.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css" >
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Расписание поездок курьеров в регионы</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                <div class="panel panel-default block">
                    <div class="panel-heading custom">
                        <h3 class="panel-title title_h3">Фильтр</h3>
                    </div>
                    <div class="panel-body">
                        <div class="title_data">
                            <form method="post" id="showSchedule">
                                <div class="form-group">
                                    <label>Выбрать дату:</label>
                                    <input type="text" id="selectDate" class="form-control input-lg" name="selectDate" placeholder="Введите дату">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default block">
                    <div class="panel-heading custom">
                        <h3 class="panel-title title_h3">Заполнить расписание</h3>
                    </div>
                    <div class="panel-body">
                        <div class="title_data">
                            <div class="hf">
                                <form method="post" id="inputSchedule">
                                    <div class="form-group">
                                        <label>Регион:</label>
                                        <select name="region" class="form-control input-lg">
                                            <?php
                                                $region = $dbh->query('SELECT * FROM `regions`');
                                                foreach($region as $region_row)
                                                {
                                                    $region_list .= '<option value="'.$region_row['id'].'" data-duration="'.$region_row['duration'].'">'.$region_row['region'].'</option>';
                                                }
                                                echo '<option selected disabled>Выбрать регион</option>'.$region_list;
                                            ?>
                                        </select>
                                        <div class="error" id="region_error">Обязательное поле*</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Дата выезда из Москвы:</label>
                                        <input type="text" id="departureDate" class="form-control input-lg" name="departureDate" placeholder="Введите дату">
                                        <div class="error" id="departureDate_error">Обязательное поле*</div>
                                    </div>
                                    <div class="form-group">
                                        <label>ФИО курьера:</label>
                                        <select name="courier" class="form-control input-lg">
                                            <?php
                                                $couriers = $dbh->query('SELECT * FROM `couriers`');
                                                foreach($couriers as $couriers_row)
                                                {
                                                    $name_list .= '<option value="'.$couriers_row['id'].'">'.$couriers_row['name'].'</option>';
                                                }
                                                echo '<option selected disabled>Выбрать курьера</option>'.$name_list;
                                            ?>
                                        </select>
                                        <div class="error" id="courier_error">Обязательное поле*</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Дата прибытия в регион:</label>
                                        <input type="text" id="arrivalDate" class="form-control input-lg" name="arrivalDate"disabled>
                                        <div class="error" id="arrivalDate_error">Обязательное поле*</div>
                                    </div>
                                    <button type="submit" class="btn button btn-lg">Отправить</button>
                                </form>
                            </div>
                            <div class="sf">Данные успешно отправлены</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="panel panel-default block">
                    <div class="panel-heading custom">
                        <h3 class="panel-title title_h3">Расписание поездок</h3>
                    </div>
                    <div class="panel-body">
                        <div class="title_data result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.datetimepicker.full.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html> 