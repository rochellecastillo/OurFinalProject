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
    <?php include_once 'res/includes.php'?>
    <title>Client Information</title>
</head>
<body>
    <?php
    include_once 'class/client.php';
    include_once 'class/employee.php';
    $c=new client();
    $e=new employee();
    include_once 'res/nav.php';
    ?>
    <div class="container">
        <form method="POST">
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="company">Company</label>
                    <select name="company" id="company" class="form-control">
                        <?php
                            $data=$c->viewallclient();
                            while($row=$data->fetch_assoc()){
                                echo "
                                    <option value='{$row['companyid']}'>{$row['companyname']}</option>
                                ";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-primary form-control" name="view">View</button>
                </div>
            </div>
        </form>
        <?php
            if(isset($_POST['remove'])){
                $employeeid=$_POST['remove'];
                echo'
                    <script>
                         Swal.fire({
                        title: "Success",
                        text: "'.$e->removeassignment($employeeid).'",
                        icon: "success"
                        });
                    </script>
                ';
            }else if(isset($_POST['view'])){
                $companyid=$_POST['company'];
                $data=$e->showassignment($companyid);
                $employeecount=$data->num_rows;
                echo'
                    <div class="mt-5 text-secondary"> <h3>Employee Count: ('.$employeecount.')</h3></div>
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Adress</th>
                                <th>Gender</th>
                                <th>Date Assigned</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                           while($row=$data->fetch_assoc()){
                            echo"
                                <form method='POST'>
                                    <tr>
                                        <td>{$row['employeeid']}</td>
                                        <td>{$row['lastname']}, {$row['firstname']} {$row['middlename']}</td>
                                        <td>{$row['address']}</td>
                                        <td>{$row['gender']}</td>
                                        <td>{$row['dateofassignment']}</td>
                                        <td>{$row['status']}</td>
                                        <td><button class='btn btn-secondary' name='remove' value='{$row['employeeid']}'>remove</button></td>
                                    </tr>
                                </form>
                            ";
                           }
                    echo' </tbody>
                    </table>
                ';
            }
        ?>
    </div>
       
</body>
</html>
