<?php
/**
 * Created by PhpStorm.
 * User: 123
 * Date: 10.06.2020
 * Time: 19:58
 */
use Application\Core\Route;
use Application\Models\User;
?>
<html lang="en" class="no-js">
<title>WORK test</title>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


        <link rel="stylesheet" type="text/css" href="/application/views/css/style.css" >

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">



    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                <?php if(User::isAuth()):?> Вы авторизованы <?php else: ?>  Вы не авторизованы   <?php endif; ?>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php Route::getUrl('auth');?>">Страница Авторизации</a>
                <a class="dropdown-item" href="<?php Route::getUrl('Registration','AddUser');?>">Страница Регистрации</a>
                <?php if(User::isAuth()):?>
                <a class="dropdown-item" href="<?php Route::getUrl('auth','logout');?>">Выйти изучетной записи</a>
                    <a class="dropdown-item" href="<?php Route::getUrl('userEdit','userEdit');?>">Изменить данные</a>

                <?php endif; ?>

            </div>
        </li>


        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
               Задачи
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php Route::getUrl('SqlTask1');?>">Первый запрос</a>
                <a class="dropdown-item" href="<?php Route::getUrl('SqlTask2');?>">Второй запрос</a>
                <a class="dropdown-item" href="<?php Route::getUrl('SqlTask2');?>">Третий Запрос</a>
            </div>
        </li>
    </ul>
</nav>



    <div class="container ">
    <?php include 'application/views/'.$content_view; ?>
    </div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script></body>
<script src="/application/views/js/my.js"></script>
</html>