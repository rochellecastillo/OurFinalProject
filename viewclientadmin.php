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
    include_once'res/nav.php';
    $data=$c->viewallclient();
    ?>

    <div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="col-md-10">
                <table class="table" id="clienttable">
                    <thead>
                        <tr>
                            <th>Company ID</th>
                            <th>Company Name</th>
                            <th>Nature of Company</th>
                            <th>Address</th>
                            <th>Contact No</th>
                            <th>Contact Person</th>
                            <th>Manpower</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($row=$data->fetch_assoc()){
                            echo"
                                <tr>
                                    <td>{$row['companyid']}</td>
                                    <td>{$row['companyname']}</td>
                                    <td>{$row['natureofcompany']}</td>
                                    <td>{$row['address']}</td>
                                    <td>{$row['contact']}</td>
                                    <td>{$row['contactperson']}</td>
                                    <td>{$c->countmanpower($row['companyid'])}</td>
                                    <td><button class='btn btn-primary' onclick='viewmanpower(&quot;{$row['companyid']}&quot;)'>view</button></td>
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
    function viewmanpower(companyid){
        window.open("viewmanpower.php?companyid="+companyid,"_new");
    }
    $(document).ready(function() {
        $('#clienttable').DataTable();
    });
</script>