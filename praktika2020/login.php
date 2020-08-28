<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Вход</title>
</head>
<body>
<?php

require 'connect.php';

if(isset($_POST['username']) and isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if ($count==1){
        $_SESSION['username'] = $username;
    } else{
        $fmsg = "Ошибка";
    }
}
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    echo "Привет ".$username." ";
    echo " Вы вошли";
    echo "<a href='user.php' class='btn btn-lg btn-primary btn-block'>Редактировать задачи</a>";
    echo "<a href='logout.php' class='btn btn-lg btn-primary btn-block'>Выход</a>";

}
?>

<div class="container">
    <form class="form-signin" method = "POST">
        <h2>Логин</h2>



        <input type="text" name="username" class="form-control" placeholder="Логин" required>
        <input type="password" name="password" class="form-control" placeholder="Пароль" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Логин</button>
        <a href="index.php" class="btn btn-lg btn-primary btn-block">Регистрация</a>

    </form>
</div>
<div class="container">

    <h2>Задачник</h2>
    <form action="nonavtoriz.php" method = "POST">
        <input type="text" name="task" id="task" placeholder="Нужно сделать..." class="form-control">
        <button type="submit" name="SendTask" class="btn btn-success">Отправить</button>
    </form>
    <?php
    require 'configDB.php';
    echo '<ul>';
    $query = $pdo->query('SELECT * FROM `tasks` ORDER BY `id` DESC');
    while($row = $query->fetch(PDO::FETCH_OBJ)) {
        echo '<li><b>'.$row->task.'</b></li>';
    }
    echo '</ul>';

    ?>
</div>


</body>
</html>