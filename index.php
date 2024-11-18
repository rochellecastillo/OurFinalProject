<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once'res/includes.php'?>
    <title>Talent Force</title>
</head>
<body>
    <?php
    include_once'class/employee.php';
    $e=new employee();
    if (isset($_POST['login'])){
        $un=$_POST['un'];
        $pw=$_POST['pw'];
        $data=$e->login($un,$pw);
        if($row=$data->fetch_assoc()){
            $_SESSION['role']=$row['role'];
            $_SESSION['userid']=$row['userid'];
            if($row['role']=='admin'){

                header('location:main.php');
            }else{
                header('location:mainhr.php');
            }
        }else{
            echo'
                <script>
                    alert("Invalid UserName or Password");
                </script>
            ';
        }
    }
    ?>
    <div class="container">
        <form method="POST">
            <div class="row justify-content-center">
                <div class="col-md-4 border p-4 mt-5">
                    <div class="row mt-3">
                        <h4 class="text-center">Talent Force</h4>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="un" class="fw-bold">User Name</label>
                            <input type="text" class="form-control" name = "un">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="pw" class="fw-bold">Password</label>
                            <input type="password" class="form-control" name = "pw">
                        </div>
                    </div>
                    <div class="row mt-3 mb-4">
                        <div class="col-md-12">
                            <button class="btn btn-primary form-control"name="login">Login</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>