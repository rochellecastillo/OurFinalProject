<?php
session_start();
if(!isset($_SESSION['userid'])){
    header('location:index.php');
}else if($_SESSION['role']!='hr'){
    header('location:main.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once'res/includes.php'?>
    <title>HR Main</title>
</head>
<body>
    <?php
    include_once'res/nav.php';
    ?>
</body>
</html>