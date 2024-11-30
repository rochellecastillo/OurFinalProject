<?php
session_start();
if(!isset($_SESSION['userid'])){
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once'res/includes.php'?>
    <title>Change Password</title>
</head>
<body>
    <?php 
        include_once 'res/nav.php';
        include_once'class/employee.php';
        $e=new employee();
        if(isset($_POST['change'])){
            $un=$_SESSION['userid'];
            $pw=$_POST['pw'];
            $pw2=$_POST['pw2'];
            $pw3=$_POST['pw3'];
            echo'
                <script>
                    Swal.fire({
                    text: "'.$e->changepassword($un,$pw,$pw2,$pw3).'",
                    });
                </script>
            ';
        }
    ?>
    <div class="container">
        <form method="POST">
            <div class="row justify-content-center">
                <div class="col-md-4 border rounded p-4 mt-4">
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <label for="pw">Password</label>
                                <input type="password" class="form-control text-center" name="pw">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="pw">New Password</label>
                                <input type="password" class="form-control text-center" name="pw2">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="pw">Re-type New Password</label>
                                <input type="password" class="form-control text-center" name="pw3">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button class="btn btn-primary form-control" name="change">Confirm Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>