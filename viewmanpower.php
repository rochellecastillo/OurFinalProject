<?php
session_start();
if(!isset($_SESSION['userid'])){
    header('location:index.php');
}else if($_SESSION['role']!='admin'){
    header('location:main.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once'res/includes.php'?>
    <title>View Client-Admin</title>
</head>
<body>
    <?php
    include_once'class/employee.php';
    include_once'class/client.php';
    $e=new employee();
    $c=new client();
    $companyid=$_GET['companyid'];
    $data=$c->viewclientinfo($companyid);
    $row=$data->fetch_assoc();
    $data2=$e->showassignment($companyid);
    ?>

    <div class="container">
       <div class="row mt-5">
            <div class="col-md-12">
                <h4><?=$row['companyname']?> - <?=$c->countmanpower($companyid)?></h4>
            </div>
       </div>
       <div class="row mt-3">
        <div class="col-md-12">
            <table id="manpowertbl">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row=$data2->fetch_assoc()){
                        echo"
                            <tr>
                                <td>{$row['employeeid']}</td>
                                <td>{$row['lastname']}, {$row['firstname']} {$row['middlename']}</td>
                                <td>{$row['address']}</td>
                                <td>{$row['gender']}</td>
                            </tr>
                        ";
                    }
                ?>
                </tbody>
            </table>
        </div>
       </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function() {
        $('#manpowertbl').DataTable();
    });
</script>