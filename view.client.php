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
    $c=new client();
    include_once 'res/nav.php';
    ?>
    <div class="container">
        <div class="row">
        <table id='clienttbl'>
            <thead>
                <tr>
                    <th>Company Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Nature</th>
                    <th>Contact</th>
                    <th>ContactPerson</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data=$c->viewallclient();
                while($row=$data->fetch_assoc()){
                    echo '
                        <tr>
                            <td>'.$row['companyid'].'</td>
                            <td>'.$row['companyname'].'</td>
                            <td>'.$row['natureofcompany'].'</td>
                            <td>'.$row['address'].'</td>
                            <td>'.$row['contact'].'</td>
                            <td>'.$row['contactperson'].'</td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#clienttbl').DataTable();
    });
</script>