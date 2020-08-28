<?php session_start(); ?>

<?php

require 'connect.php';
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    echo "Привет ".$username.",";
    echo " добавьте свою задачу.";
    }

    echo "<a href='logout.php' class='btn btn-lg btn-primary btn-block'>Выйти с аккаунта</a>";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Юзер</title>
</head>
<body>


<div class="container">

    <h2>Задачник</h2>
    <form action="add.php" method = "POST">
        <input type="text" name="task" id="task" placeholder="Нужно сделать..." class="form-control">
        <button type="submit" name="SendTask" class="btn btn-success">Отправить</button>
    </form>
    <?php
    require 'configDB.php';

    echo '<ul>';
    $query = $pdo->query('SELECT * FROM `tasks` ORDER BY `id` DESC');
    while($row = $query->fetch(PDO::FETCH_OBJ)) {
        echo '<li><b>'.$row->task.'</b><a href="delete.php?id='.$row->id.'"><button>Удалить</button></a></li>';
    }
    echo '</ul>';
    ?>
</div>
</body>
</html>